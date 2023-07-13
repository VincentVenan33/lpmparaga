@extends('layouts.template-reader')
@section('reader')
<header class="entry-header header-padding">
    <h1 class="header entry-title" style="width: 90%; margin: auto;">About LPM Paraga</h1>
</header>
<div class="container pagecontent mini-card">
    <div class="card" id="history-card">
        <div class="card-content">
          <h3>History of Paraga</h3>
          <img class="camera" src="{{ url('') }}/images/Camera.png" alt="Foto Paraga">
          <p>Paraga adalah lembaga pers mahasiswa yang tergabung dalam salah satu unit kegiatan mahasiswa di Universitas Katolik Soegijapranata. Nah, Paraga ini didirikan oleh Bapak Hermawan Paneasiwi, dosen Fakultas Hukum dari Universitas Katolik Soegijapranata pada tahun 1995. Lalu, kata "Paraga" sendiri artinya apa? Kata "Paraga" berasal dari bahasa Sanskerta atau jika dalam bahasa Jawa "progo", yang berarti pameran, tokoh, dan sejenisnya. Oleh karena itu, Paraga diharapkan dapat menjadi wadah bagi mahasiswa yang memiliki minat dan bakat di bidang tulis-menulis, terutama jurnalistik, untuk mengembangkan diri.</p>
        </div>
      </div>
      <div class="card" id="logo-card">
        <div class="card-content">
          <h3>Logo Paraga</h3>
          <img src="{{ url('') }}/images/Paraga HD png bg.png" alt="Foto Paraga">
          <img src="{{ url('') }}/images/16024254591111.png" alt="Foto Paraga">
        </div>
      </div>
      <div class="card" id="members-card">
        <div class="card-content">
          <h3>Daftar Anggota Paraga</h3>
          @foreach($anggota as $agt)
          <ul class="daftar-mini">
            <li>{{ $agt->jabatan }}~{{ $agt->nama }}</li>
          </ul>
          @endforeach
        </div>
      </div>

      <div class="dialog-overlay" id="history-dialog">
        <div class="dialog-card">
          <div class="dialog-card-content">
            <h3>History of Paraga</h3>
            <img class="big-camera" src="{{ url('') }}/images/Camera.png" alt="Foto Paraga">
            <p>Paraga adalah lembaga pers mahasiswa yang tergabung dalam salah satu unit kegiatan mahasiswa di Universitas Katolik Soegijapranata. Nah, Paraga ini didirikan oleh Bapak Hermawan Paneasiwi, dosen Fakultas Hukum dari Universitas Katolik Soegijapranata pada tahun 1995. Lalu, kata "Paraga" sendiri artinya apa? Kata "Paraga" berasal dari bahasa Sanskerta atau jika dalam bahasa Jawa "progo", yang berarti pameran, tokoh, dan sejenisnya. Oleh karena itu, Paraga diharapkan dapat menjadi wadah bagi mahasiswa yang memiliki minat dan bakat di bidang tulis-menulis, terutama jurnalistik, untuk mengembangkan diri.</p>
          </div>
        </div>
      </div>
      <div class="dialog-overlay" id="logo-dialog">
        <div class="dialog-card">
          <div class="dialog-card-content">
            <h3>Logo Paraga</h3>
            <img class="square" src="{{ url('') }}/images/Paraga HD png bg.png" alt="Foto Paraga">
            <img src="{{ url('') }}/images/16024254591111.png" alt="Foto Paraga">
          </div>
        </div>
      </div>
      <div class="dialog-overlay" id="members-dialog">
        <div class="dialog-card">
          <div class="dialog-card-content">
            <h3>Daftar Anggota Paraga</h3>
            @foreach($anggota as $agt)
            <ul class="daftar-modal">
                <li>{{ $agt->jabatan }}~{{ $agt->nama }}</li>
            </ul>
            @endforeach
          </div>
        </div>
      </div>

      <script>
        const historyCard = document.getElementById('history-card');
        const logoCard = document.getElementById('logo-card');
        const membersCard = document.getElementById('members-card');
        const historyDialog = document.getElementById('history-dialog');
        const logoDialog = document.getElementById('logo-dialog');
        const membersDialog = document.getElementById('members-dialog');

        function showDialog(dialog) {
          dialog.style.display = 'flex';
        }

        function hideDialog(dialog) {
          dialog.style.display = 'none';
        }

        historyCard.addEventListener('click', function() {
          showDialog(historyDialog);
        });

        logoCard.addEventListener('click', function() {
          showDialog(logoDialog);
        });

        membersCard.addEventListener('click', function() {
          showDialog(membersDialog);
        });

        historyDialog.addEventListener('click', function(event) {
          if (event.target === historyDialog) {
            hideDialog(historyDialog);
          }
        });

        logoDialog.addEventListener('click', function(event) {
          if (event.target === logoDialog) {
            hideDialog(logoDialog);
          }
        });

        membersDialog.addEventListener('click', function(event) {
          if (event.target === membersDialog) {
            hideDialog(membersDialog);
          }
        });
      </script>
</div>
@endsection
