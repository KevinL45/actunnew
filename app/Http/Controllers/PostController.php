<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function create()
    {
        return view("post.form",[
            'post' => new Post()
        ]);
    }

    public function store(Request $request)
    {

        # 1ere Façon => La VALIDATION du formulaire peut s'effectuée dans le Controller
        try {
           $this->validate(Request::capture(),[
               'title'=>'bail|required|max:255',
               'content'=>'required',
               'featuredImage'=>'bail|image|mimes:jpeg,jpg,png|max:3072'//3 mo
           ]);

        } catch (ValidationException $exception) {

            return back();
        }
        $category = Category::findOrFail($request->input('category'));


        # Génération de l'alias grâce à la méthode slug() de Illuminate\Support\Str
        $alias = Str::slug($request->input('title'));

        # Récupère depuis la requête le fichier uploadé. La méthode file() nous retourne un objet de type UploadedFile.
        $photo = $request->file('featuredImage');

        # Variabilise l'extension du fichier uploadé grâce à la méthode guessExtension() de UploadedFile.
        // => cet appel est de confiance car la méthode s'appuie sur le mimeType du fichier.
        $extention = $photo->guessExtension();
        # Récupération du nom original du fichier
        $originalfilename = str_replace($extention,'',$photo->getClientOriginalName()) ;

        # Génération d'un nouveau nom de fichier avec l'alias de l'article et l'extension variabilisée.
        $newfilename= $originalfilename.'-'.uniqid().'.'.$extention;

        # storeAs() vous permet de déplacer le fichier dans le dossier
        // => Elle permet de renommer le fichier qui va être déplacer
        $photo->storeAs('public/posts',$newfilename);

        $post = new Post();

        $post->title = $request->input('title');
        $post->alias = $alias;
        $post->content = $request->input('content');
        $post->photo = $newfilename;
        //les relations
        $post->category()->associate($category);
        $post->user()->associate(1);

        $post->save();

        return redirect('/');








    }
}
