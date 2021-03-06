<div class="container mb-5">
   <div class="row">
      <div class="col">
         <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link {{ $className == 'home' ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link {{ $className == 'cats' ? 'active' : '' }}" href="{{ route('cats') }}">Cats</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link {{ $className == 'dogs' ? 'active' : '' }}" href="{{ route('dogs') }}">Dogs</a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </div>
   </div>
</div>