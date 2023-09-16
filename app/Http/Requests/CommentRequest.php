<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getPostRules($this->input('class'));
    }

    public function getPostRules($class){
        $rules = [];
        switch ($class){
            case "addComment":
                $rules = [
                    'content' => 'required',
                ];
                break;
            case "deleteComment":
                $rules = [
                    'comment_id' => 'required|exists:comments,id',
                ];
                break;
            case "updateComment":
                $rules = [
                    'content' => 'required',
//            '     status' => 'in:0,1',
                    'comment_id' => 'required|exists:comments,id',
                ];
                break;
            case "specificComment":
                $rules = [
                    'comment_id' => 'required|exists:comments,id',
                ];
                break;
            case "toggleComment":
                $rules = [
                    'comment_id' => 'required|exists:comments,id',
                ];
                break;
        }
        return $rules;
    }
}
