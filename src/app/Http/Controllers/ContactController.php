<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
  public function index(Request $request)
  {
    return view('index');

    $query = Contact::query();
    $categories = Category::all();
    if ($request->filled('name_or_email')) {
      $search_term = $request->name_or_email;
      $query->where(function ($q) use ($search_term) {
        $q->where('first_name', 'LIKE', "%{$search_term}%")
        ->orWhere('last_name', 'LIKE', "%{$search_term}%")
        ->orWhere('email', 'LIKE', "%{$search_term}%");
      });
    }
    if ($request->filled('gender') && $request->gender !== 'all') {
      $query->where('gender', $request->gender);
    }
    if ($request->filled('category_id')) {
      $query->where('category_id', $request->category_id);
    }
    if ($request->filled('date')) {
      $query->whereDate('created_at', $request->date);
    }
    $contacts = $query->with('category')
    ->paginate(7);
    $searchParams = $request->only(['name_or_email', 'gender', 'category_id', 'date']);
    return view('admin.contacts.index', compact('contacts', 'categories', 'searchParams'));
  }

  public function confirm(ContactRequest $request)
  {
    $contact = $request->only(['name', 'email', 'tel', 'content']);
    return view('confirm', compact('contact'));
  }

  public function store(ContactRequest $request)
  {
    $contact = $request->only(['name', 'email', 'tel', 'content']);
    Contact::create($contact);
    return view('thanks');
  }
  public function show(Contact $contact)
  {
    $contact->load('category');
    $contact->append(['gender_string', 'full_name']);
    return response()->json($contact);
  }
  public function destroy(Contact $contact)
  {
    try {
      $contact->delete();
      return response()->json(['success' => true, 'message' => 'データを削除しました。']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'データの削除に失敗しました。', 'error' => $e->getMessage()], 500);
    }
  }
  public function exportCsv(Request $request)
  {
      $query = Contact::query();
      if ($request->filled('name_or_email')) {
          $search_term = $request->name_or_email;
          $query->where(function ($q) use ($search_term) {
              $q->where('first_name', 'LIKE', "%{$search_term}%")
                ->orWhere('last_name', 'LIKE', "%{$search_term}%")
                ->orWhere('email', 'LIKE', "%{$search_term}%");
          });
      }

      if ($request->filled('gender') && $request->gender !== 'all') {
          $query->where('gender', $request->gender);
      }

      if ($request->filled('category_id')) {
          $query->where('category_id', $request->category_id);
      }

      if ($request->filled('date')) {
          $query->whereDate('created_at', $request->date);
      }
      $contacts = $query->with('category')->orderBy('created_at', 'desc')->get();

      $filename = "contacts_export_" . date('Ymd_His') . ".csv";

      $headers = [
          "Content-type"        => "text/csv; charset=UTF-8",
          "Content-Disposition" => "attachment; filename=\"$filename\"",
          "Pragma"              => "no-cache",
          "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
          "Expires"             => "0"
      ];

      $callback = function() use ($contacts) {
          $file = fopen('php://output', 'w');
          fwrite($file, "\xEF\xBB\xBF");
          fputcsv($file, [
              'ID',
              '姓',
              '名',
              '性別',
              'メールアドレス',
              '電話番号',
              '住所',
              '建物名',
              'お問い合わせの種類',
              'お問い合わせ内容',
              'お問い合わせ日時'
          ]);

          foreach ($contacts as $contact) {
              fputcsv($file, [
                  $contact->id,
                  $contact->first_name,
                  $contact->last_name,
                  $contact->gender_string,
                  $contact->email,
                  $contact->tel,
                  $contact->address,
                  $contact->building,
                  $contact->category->name,
                  $contact->detail,
                  $contact->created_at ? $contact->created_at->format('Y-m-d H:i:s') : '',
              ]);
          }
          fclose($file);
      };

      return Response::stream($callback, 200, $headers);
  }
}