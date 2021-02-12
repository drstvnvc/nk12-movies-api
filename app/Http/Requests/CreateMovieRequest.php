<?php

namespace App\Http\Requests;

use App\Rules\UniqueWithReleaseDate;
use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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

  private $genres = ['action', 'sci-fi', 'horror', 'comedy'];
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => ['required','string', new UniqueWithReleaseDate($this->release_date)],
      'director' => 'required|string',
      'imageUrl' => 'required|url',
      'duration' => 'required|integer|min:0',
      'release_date' => 'required|date',
      'genre' => 'required|string|in:' . implode(',', $this->genres),
    ];
  }
}
