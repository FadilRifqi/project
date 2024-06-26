<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\Tanding\VerifikasiPelanggaran;
use App\Events\Tanding\TambahPeringatan;
use App\Events\Tanding\TambahTeguran;
use App\Events\Tanding\TambahJatuhan;
use App\Events\Tanding\TambahBinaan;
use App\Events\Tanding\GantiBabak;
use App\Events\Tanding\Hapus;
use App\Models\JadwalTanding;
use App\Models\Tanding;
use App\Models\Gelanggang;
use App\Models\PenilaianTanding;

class DewanTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $recent = [[],[]];
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->get();    
    }
    public function hapusTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        Hapus::dispatch($id,end($this->recent[0]),$this->jadwal->babak_tanding);
        }else{
        Hapus::dispatch($id,end($this->recent[1]),$this->jadwal->babak_tanding);           
        }
        array_pop($this->recent);
    }
    public function tambahPeringatanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'peringatan');
        }else{
        array_push($this->recent[1],'peringatan');           
        }
        
        TambahPeringatan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahTeguranTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'teguran');
        }else{
        array_push($this->recent[1],'teguran');           
        }        
        TambahTeguran::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahBinaanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'binaan');
        }else{
        array_push($this->recent[1],'binaan');           
        }
        TambahBinaan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahJatuhanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'jatuhan');
        }else{
        array_push($this->recent[1],'jatuhan');           
        }        
        TambahJatuhan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function GantiBabakTrigger($id){
        GantiBabak::dispatch($id);
    }
    #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler(){
        ;
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler(){
        ;
    }
    #[On('echo:poin,.hapus')]
    public function hapusHandler(){
        
    }
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        $this->recent = [[],[]];
    }
    
    public function render()
    {
        return view('livewire.dewan-tanding',[
        'jadwal'=> $this->jadwal,
        'sudut_merah'=>$this->sudut_merah,
        'sudut_biru'=>$this->sudut_biru,
        'penilaian_tanding_biru'=>$this->penilaian_tanding_biru,
        'penilaian_tanding_merah'=>$this->penilaian_tanding_merah
        ])->extends('layouts.dewan.app')->section('content');
    }
}
