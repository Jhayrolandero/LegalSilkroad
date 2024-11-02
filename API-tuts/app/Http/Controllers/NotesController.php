<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Service\JWTService;
use Illuminate\Http\Request;
use Laravel\Prompts\Note;

class NotesController extends Controller
{
    public function __construct(
        protected JWTService $JWTService
    ){}


    /**
     * Get user associated notes
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getUserNotes() {
        try {

            $notes = Notes::where('user_id', $this->JWTService->parseToken()->id)
            ->get();
            
            return response()->json(compact('notes'));
        } catch(\Exception $e) {
            return response()->json($e, 400);
        }
    }
}
