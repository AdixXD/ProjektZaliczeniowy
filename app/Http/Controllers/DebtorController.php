<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debtor;


class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $debtor=Debtor::where('user_id', auth()->user()->id)->orderBy('created_at', 'asc')->get();
//       $debtor= Debtor::orderBy('created_at', 'asc')->get();
       $temp=0;
       foreach($debtor as $debt)
       {
           $temp+=$debt->money;
       }
       
      $grupy=Debtor::where('user_id', auth()->user()->id)->GroupBy('name')->orderBy('name')->selectRaw('sum(money) as Suma')->get();
       $whos= Debtor::where('user_id', auth()->user()->id)->selectRaw('DISTINCT(name)')->orderBy('name')->get('name');
       //$howmuchs= Debtor::where('user_id', auth()->user()->id)->distinct('name')->count('name');
        return view('debtor', [
            'debtor' => $debtor,
             'allmoney' => $temp, 
             'grupy' => $grupy,
             'whos' => $whos
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $debtor= new Debtor;
        return view('debtorForm', ['debtor' => $debtor]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Podstawowa walidacja formularza:
 $this->validate($request, [
 'name' => 'required|regex:/^[A-Z][a-ząęćłóńżźś]{1,15}\s[A-Z][a-ząęćłóńżźś]{0,15}$/',
 'email' => 'email',
 'money' =>'regex:/^\d+(\.\d{1,2})?$/'
 ]);
 if(\Auth::user() == null){
     return view('welcome');
 }
 $debtor = new Debtor();
 $debtor->user_id=\Auth::user()->id;
 $debtor->name=$request->name;
 $debtor->email=$request->email;
 $debtor->money=$request->money;
 if($debtor->save()){
     return redirect('debtor');
 }
 return view('debtor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $debtor = Debtor::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if (\Auth::user()->id != $debtor->user_id) {
        return back()->with(['success' => false, 'message_type' => 'danger',
        'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
    }
    return view('debtorEditForm', ['debtor'=>$debtor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $debtor = Debtor::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if(\Auth::user()->id != $debtor->user_id)
            {
                return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
            }
            $debtor->name = $request->name;
            $debtor->email = $request->email;
            $debtor->money = $request->money;


            if($debtor->save()) {
            return redirect()->route('debtor');
            }
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //Znajdź dluznika o danych id:
    $debtor = Debtor::find($id);
    //Sprawdz czy użytkownik jest autorem komentarza:
    if(\Auth::user()->id != $debtor->user_id)
    {
    return back();
    }
    if($debtor->delete()){
    return redirect()->route('debtor');
    }
    else return back();
    }
}
