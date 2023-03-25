<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\EmailException;

class ContactFormController extends Controller
{
    public function sendEmail(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        try {
            mail('optobeats@gmail.com', 'Запрос на обратную связь', "Имя: {$validatedData['name']}, Телефон: {$validatedData['phone']}");
        } catch (\Exception $e) {
            throw new EmailException();
        }

        return response()->json([
            'message' => 'Спасибо за обращение! Наш менеджер свяжется с вами в ближайшее время'
        ]);
    }
}
