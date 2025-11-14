<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where all web routes for the Cool Tech project are defined.
| These routes handle public pages, article/category/tag pages, search,
| writer/admin consoles, and authentication.
|
*/

// --------------------
// Public Routes
// --------------------

// Home page - shows latest 5 articles
Route::get('/', function () {
    $articles = DB::table('articles')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    return view('home', ['articles' => $articles]);
});

// Article page by ID
Route::get('/article/{id}', function ($id) {
    $article = DB::table('articles')->where('id', $id)->first();

    if (!$article) return "Article not found.";

    // Get category and associated tags
    $category = DB::table('categories')->where('id', $article->category_id)->first();
    $tags = DB::table('article_tag')
        ->join('tags', 'article_tag.tag_id', '=', 'tags.id')
        ->where('article_tag.article_id', $id)
        ->get();

    return view('article', [
        'article' => $article,
        'category' => $category,
        'tags' => $tags
    ]);
});

// Category page by slug
Route::get('category/{slug}', function ($slug) {
    $category = DB::table('categories')->where('slug', $slug)->first();
    if (!$category) return "Category not found.";

    $articles = DB::table('articles')
        ->where('category_id', $category->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('category', ['category' => $category, 'articles' => $articles]);
});

// Tag page by slug
Route::get('/tag/{slug}', function ($slug) {
    $tag = DB::table('tags')->where('slug', $slug)->first();
    if (!$tag) return "Tag not found.";

    // Get articles associated with this tag
    $articles = DB::table('article_tag')
        ->join('articles', 'article_tag.article_id', '=', 'articles.id')
        ->where('article_tag.tag_id', $tag->id)
        ->orderBy('articles.created_at', 'desc')
        ->select('articles.*')
        ->get();

    return view('tag', ['tag' => $tag, 'articles' => $articles]);
});

// About & Legal pages
Route::get('/about', fn() => view('about'));
Route::get('/legal', fn() => view('legal'));

// --------------------
// Search Functionality
// --------------------

// Search form
Route::get('/search', fn() => view('search'));

// Handle search queries (by ID, category, or tag using LIKE for partial matches)
Route::get('/search/result', function (Request $request) {
    $id = $request->query('id');
    $categoryInput = $request->query('category');
    $tagInput = $request->query('tag');

    if ($id) return redirect('/article/' . $id);

    if ($categoryInput) {
        $category = DB::table('categories')->where('slug', 'like', "%$categoryInput%")->first();
        return $category ? redirect('/category/' . $category->slug) : "Category not found.";
    }

    if ($tagInput) {
        $tag = DB::table('tags')->where('slug', 'like', "%$tagInput%")->first();
        return $tag ? redirect('/tag/' . $tag->slug) : "Tag not found.";
    }

    return "No search criteria provided.";
});

// --------------------
// Writer Console
// --------------------

// Show writer console (restricted to writers/admin)
Route::get('/writer', function () {
    if (!in_array(Session::get('user_role'), ['writer', 'admin'])) return "Access denied.";
    return view('writer');
});

// Handle article submission
Route::post('/writer', function (Request $request) {
    if (!in_array(Session::get('user_role'), ['writer', 'admin'])) return "Access denied.";

    // Insert article
    $articleId = DB::table('articles')->insertGetId([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'category_id' => $request->input('category_id'),
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Handle tags (comma-separated)
    $tagsArray = explode(',', $request->input('tags'));
    foreach ($tagsArray as $tagName) {
        $tagName = trim($tagName);
        if ($tagName === '') continue;

        $tag = DB::table('tags')->where('name', $tagName)->first();
        $tagId = $tag ? $tag->id : DB::table('tags')->insertGetId([
            'name' => $tagName,
            'slug' => Str::slug($tagName)
        ]);

        DB::table('article_tag')->insert([
            'article_id' => $articleId,
            'tag_id' => $tagId
        ]);
    }

    return "Article submitted successfully!";
});

// --------------------
// Admin Console
// --------------------

// Show admin console (restricted to admin)
Route::get('/admin', function () {
    if (Session::get('user_role') !== 'admin') return "Access denied.";

    return view('admin', [
        'categories' => DB::table('categories')->get(),
        'articles' => DB::table('articles')->get()
    ]);
});

// Handle admin actions (create/rename category, delete article)
Route::post('/admin', function (Request $request) {
    if (Session::get('user_role') !== 'admin') return "Access denied.";

    $action = $request->input('action');

    switch ($action) {
        case 'create_category':
            $name = $request->input('category_name');
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
            return redirect('/admin');

        case 'rename_category':
            $id = $request->input('category_id');
            $newName = $request->input('new_name');

            // Check for duplicate category
            if (DB::table('categories')->where('slug', Str::slug($newName))->exists()) {
                return "Category with this name already exists!";
            }

            DB::table('categories')->where('id', $id)->update([
                'name' => $newName,
                'slug' => Str::slug($newName)
            ]);
            return redirect('/admin');

        case 'delete_article':
            $id = $request->input('article_id');

            // Delete pivot records first to avoid foreign key errors
            DB::table('article_tag')->where('article_id', $id)->delete();

            // Delete article
            DB::table('articles')->where('id', $id)->delete();
            return redirect('/admin');

        default:
            return "Unknown action.";
    }
});

// --------------------
// Authentication
// --------------------

// Show registration form
Route::get('/register', fn() => view('register'));

// Handle registration
Route::post('/register', function (Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $password = Hash::make($request->input('password')); // hash password
    $role = 'writer'; // default role

    // Prevent duplicate email
    if (DB::table('users')->where('email', $email)->exists()) return "Email already registered.";

    DB::table('users')->insert([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'role' => $role,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return "Registration successful! <a href='/login'>Login</a>";
});

// Show login form
Route::get('/login', fn() => view('login'));

// Handle login
Route::post('/login', function (Request $request) {
    $user = DB::table('users')->where('email', $request->input('email'))->first();

    if (!$user || !Hash::check($request->input('password'), $user->password)) return "Invalid credentials.";

    // Store user info in session
    Session::put('user_id', $user->id);
    Session::put('user_name', $user->name);
    Session::put('user_role', $user->role);

    return redirect('/');
});

// Logout user
Route::get('/logout', function () {
    Session::flush();
    return redirect('/');
});
