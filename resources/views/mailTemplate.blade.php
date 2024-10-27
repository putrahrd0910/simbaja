<!DOCTYPE html>
<html>

<head>
  <title>Verifikasi Akun</title>
</head>

<body>
  <p>Halo <b>{{$details['nama_lengkap']}}</b>!</p>
  <p>Berikut ini adalah Data Anda:</p>
  <table>
    <tr>
      <td>NIK</td>
      <td>:</td>
      <td>{{$details['nik']}}</td>
    </tr>
    <tr>
      <td>NIP</td>
      <td>:</td>
      <td>{{$details['nip']}}</td>
    </tr>
    <tr>
      <td>Nama Lengkap</td>
      <td>:</td>
      <td>{{$details['nama_lengkap']}}</td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td>:</td>
      <td>{{$details['tanggal_lahir']}}</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>{{$details['jenis_kelamin']}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{$details['alamat']}}</td>
    </tr>
    <tr>
      <td>Telepon</td>
      <td>:</td>
      <td>{{$details['telepon']}}</td>
    </tr>
    <tr>
      <td>Username</td>
      <td>:</td>
      <td>{{$details['username']}}</td>
    </tr>
    <!-- <tr>
        <td>Role</td>
        <td>:</td>
        <td>{{$details['roleId']}}</td>
      </tr> -->
    <tr>
      <td>Website</td>
      <td>:</td>
      <td>{{$details['website']}}</td>
    </tr>
    <tr>
      <td>Tanggal Register</td>
      <td>:</td>
      <td>{{$details['datetime']}}</td>
    </tr>
  </table>

  <center>
    <h3>Copy link di bawah ini ke browser Anda untuk Verifikasi Akun:</h3>
    <b style="color:blue">{{$details['url']}}</b>
  </center>

  <p>Terima kasih telah melakukan registrasi.</p>
</body>

</html>