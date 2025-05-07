<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Members_form_fillup_status extends Model
{
    use HasFactory;
    protected $table = 'member_form_fillUp_status';
    protected $fillable =[
        'member_id',
        'form_steps',
    ];

    public function registerFormSteps($memberId){
        try {
            Members_form_fillup_status::create([
                'member_id' => $memberId
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }

    public function getFormSteps($memberId){
        try {
            $formSteps = Members_form_fillup_status::where('member_id', $memberId)->first();
            return $formSteps;

        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }

    public function updateFormSteps($memberId, $formSteps, $form_fillup_status){
        try {
            Members_form_fillup_status::where('member_id', $memberId)->update([
                'form_steps' => $formSteps,
                'form_fillup_status'=> $form_fillup_status,
            ]);
            return true;

        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

        
    }
}
