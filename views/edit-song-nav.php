  <!-- EDIT SONG NAVBAR -->

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          dream state generator
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a><? echo $song['title']; ?></a></li>
          <li><a href="../edit-song-info/<? echo $song['id']; ?>">Info</a></li>
          <li><a href="../edit-song-fragments/<? echo $song['id']; ?>">Fragments</a></li>
          <li><a href="rhymes">Rhymes</a></li>
        </ul>
      </div>      
    </div>
  </nav>  

