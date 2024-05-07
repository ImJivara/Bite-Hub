<?php

namespace App\Http\Controllers;
use App\Models\Recipes;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class RecipeController extends Controller
{
    public function getRecipes(Request $request)
    {  
        if($request->id==null)
        {
            $recipes=Recipes::all();
            $FeaturedRecipe = $recipes->sortByDesc('NbLikes')->first();
            
            return view('Recipes',['rec'=>$recipes,'featuredrec'=>$FeaturedRecipe] );
        }
        else{
            $recipe=Recipes::findOrFail($request->id);
            if($recipe==null) dd("such post doesnt exist");
            else
            $ingredients=$recipe->ingredients_details;
            $ingredients=explode("-",$ingredients);
            $step=$recipe->steps_details;
            $step=explode("-",$step);
            return view('Recipe',['r'=>$recipe,'ing'=>$ingredients,'steps'=>$step] );
        } 
    }
    
    public function getStep(Request $request)
    {   
        $recipe=Recipes::findOrFail($request->id);
        if($recipe==null) dd("such post doesnt exist");
        else
        $step=$recipe->steps_details;
        $step=explode("-",$step);
        return view('step',['steps'=>$step,'rec'=>$recipe]);


    }

    public function getIng(Request $request)
    {
        $recipe=Recipes::findOrFail($request->id);
        if($recipe==null) dd("such post doesnt exist");
        else
        $Ing=$recipe->ingredients_details;
        $Ing=explode("-",$Ing);
        return view('Ingredients',['Ing'=>$Ing,'rec'=>$recipe]);

    }
    public function IncLikes(Request $request)
    {   $recipe=Recipes::find($request->id);
        $recipe->increment('NbLikes');
        $recipe->save();
        $recipe2=Recipes::find($request->id);
        $NbLikes=$recipe2->NbLikes;
        return response()->json([ 'NbLikes'=>$NbLikes ]);

    }
    public function DecLikes(Request $request)
    {   $recipe=Recipes::find($request->id);
        $recipe->decrement('NbLikes');
        $recipe->save();
        $recipe2=Recipes::find($request->id);
        $NbLikes=$recipe2->NbLikes;
        return response()->json([ 'NbLikes'=>$NbLikes ]);

    }
    
   

    public function like(Recipes $recipe)
    {
        $recipe->increment('NbLikes');
        return response()->json(['likes' => $recipe->NbLikes]);
    }
}

