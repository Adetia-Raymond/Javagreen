@php
    $waktuupdate =  $data->updated_at;
    $perbedaandetik = $waktuupdate->diffInSeconds($currentDateTime);
    if (abs($perbedaandetik) >= 30) {
        echo "TIDAK AKTIF";
    }
    else{
        echo "AKTIF";
    }
@endphp