<?php

namespace App\Http\Controllers;

use App\Mail\UserCommentAPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

CONST status = ['APPROVED', 'NO APPROVED'];
class PostController extends Controller
{

    /**
     * Obtain publications with a Hola and status 'aproved'
     *
     * @return Publication[] 
     */
    public function holaAndAproved()
    {
        $publicationsResult = Publication::whereHas('comments', function (Builder $query) {
            $query->where('content', 'like', '%hola%')->where('status', status[0]);
         })->get();
        return response()->json([
            'publications' => $publicationsResult
        ]);
    }


    /**
     * Crea la vista principal donde se ven todos los post
     *
     * @return void
     */
    public function seeAllPosts(){
        $publicationsResult = Publication::with('autor')->orderBy('created_at','desc')->paginate(15);
        return view('home.home', ['publications' => $publicationsResult]);
    } 
    
    /**
     * Muestra la vista de un post en especifico
     *
     * @param [int] $id id del post a revisar
     * @return void
     */
    public function seePost($id){
        $user_id = Auth::user()->id;
        $publicationsResult = Publication::with('autor', 'comments.user')->where('id', $id)->first();
        $hasComment = Comment::where(["user_id"=>$user_id,"publication_id"=>$id] )->count();
        return view('home.post', ['post' => $publicationsResult, 'hasPost' => $hasComment === 0]);
    }
    
    /**
     * Agrega un comentario a un post
     *
     * @param Request $request
     * @return void
     */
    public function addComment(Request $request){
        $validator =  Validator::make($request->all(), [
            'id' => 'required',
            'comentario' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->intended('/post_'.$request->id)->withErrors($validator);
        }
        $user_id = Auth::user()->id;
        $hasComment = Comment::where(["user_id"=>$user_id,"publication_id"=>$request->id] )->count();
        if ($hasComment !== -1){
            $comment = new Comment();
            $comment->publication_id = $request->id;
            $comment->content = $request->comentario;
            $comment->status = status[0];
            $comment->user_id = $user_id;
            $comment->save();
            Mail::to($comment->publication->autor->email)->send(new UserCommentAPost($comment));
            return redirect()->intended('/post_'.$request->id);
        }else{
            $validator->errors()->add('error', 'Solo puede hacer un comentario en el mismo post');
            return redirect()->intended('/post_'.$request->id)->withErrors($validator);
        }
       
        
    }
}
