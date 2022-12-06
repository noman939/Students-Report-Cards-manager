<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{
    public function delete_attachment(Request $request)
    {
        $id = $request->attachment_id;
        $attachment = Attachment::where('id', $id)->first();
        
        $attachment->delete();
        return response()->json(['status', '']);
    }
}
