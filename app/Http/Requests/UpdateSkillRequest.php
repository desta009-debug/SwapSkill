<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'offers' => ['nullable', 'array'],
            'offers.*' => ['exists:skills,id'],

            'wants' => ['nullable', 'array'],
            'wants.*' => ['exists:skills,id'],

            'offer_levels' => ['nullable', 'array'],
            'want_levels' => ['nullable', 'array'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $offers = array_unique($this->input('offers', []));
            $wants = array_unique($this->input('wants', []));

            $offerLevels = $this->input('offer_levels', []);
            $wantLevels = $this->input('want_levels', []);

            $validLevels = ['beginner', 'intermediate', 'advanced'];

            $sameSkills = array_intersect($offers, $wants);

            if (!empty($sameSkills)) {
                $validator->errors()->add('skills', 'Skill yang sama tidak boleh dipilih di Offer dan Want sekaligus.');
            }

            foreach ($offers as $skillId) {
                if (!isset($offerLevels[$skillId]) || !in_array($offerLevels[$skillId], $validLevels, true)) {
                    $validator->errors()->add('offer_levels', 'Semua skill Offer wajib punya level yang valid.');
                    break;
                }
            }

            foreach ($wants as $skillId) {
                if (!isset($wantLevels[$skillId]) || !in_array($wantLevels[$skillId], $validLevels, true)) {
                    $validator->errors()->add('want_levels', 'Semua skill Want wajib punya level yang valid.');
                    break;
                }
            }
        });
    }

    public function getOffers(): array
    {
        return array_unique($this->input('offers', []));
    }

    public function getWants(): array
    {
        return array_unique($this->input('wants', []));
    }

    public function getOfferLevels(): array
    {
        return $this->input('offer_levels', []);
    }

    public function getWantLevels(): array
    {
        return $this->input('want_levels', []);
    }
}
