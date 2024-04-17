<?php

namespace App\Livewire;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use Livewire\Attributes\On;

use Livewire\Component;

class PenontonTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $PenilaianTanding_merah;
    public $PenilaianTanding_biru;
    public $waktu ;

    public function mount(){
        $this->gelanggang = Gelanggang::find(1)->first();
        $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
        $this->waktu = $this->gelanggang->waktu * 3;
        $this->pesilat_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->pesilat_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->PenilaianTanding_merah= PenilaianTanding::where('atlet',$this->pesilat_merah->id)->where('PenilaianTanding',$this->jadwal->PenilaianTanding_tanding)->first();
        $this->PenilaianTanding_biru= PenilaianTanding::where('atlet',$this->pesilat_biru->id)->where('PenilaianTanding',$this->jadwal->PenilaianTanding_tanding)->first();   
    }

    public function decrementWaktu()
    {   
        if($this->waktu == 0) return;
        $this->waktu -= 0.01;
    }

     #[On('echo:arena,.ganti-babak')]
    public function GantiBabakHandler(){
        ;
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
   

    public function render()
    {
        return view('livewire.penonton-tanding',[
            'jadwal'=> $this->jadwal,
            'pesilat_merah'=>$this->pesilat_merah,
            'pesilat_biru'=>$this->pesilat_biru,
            'PenilaianTanding_biru'=>$this->PenilaianTanding_biru,
            'PenilaianTanding_merah'=>$this->PenilaianTanding_merah
            ])->extends('layouts.client.app')->section('content');
    }
}
