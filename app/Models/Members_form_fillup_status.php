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

    public function getFormSteps($memberId){
        try {
            $formSteps = Members_form_fillup_status::where('member_id', $memberId)->first();
            return $formSteps->form_steps;

        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }

    public function updateFormSteps($memberId, $formSteps){
        try {
            Members_form_fillup_status::where('member_id', $memberId)->update([
                'form_steps' => $formSteps
            ]);
            return true;

        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

        
    }
}
