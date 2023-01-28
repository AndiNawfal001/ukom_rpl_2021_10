<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('image/aa.png') }}" sizes="16x16">
    <title>MyStock</title>
</head>
<body>

    <div class="hero min-h-screen bg-base-100 select-none">
        <div class="hero-content w-full flex-col lg:flex-row-reverse gap-7"  data-aos="zoom-in" duration="2000">
            <div class="card flex-shrink-0 w-full max-w-sm border bg-gray-50">
                <div class="card-body w-full">
                    <div class="w-full text-center">
                        <img src="{{ asset('image/aa.png') }}" class="mx-auto w-14">
                        <h1 class="text-2xl font-light my-2 ">Sign in to MyStock</h1>
                    </div>
                @if($errors->any())
                @foreach($errors->all() as $err)
                <div class="alert alert-error shadow-lg" >
                    <span>{{ $err }}</span>
                    <button class="btn-sm">
                        <svg  class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                @endforeach
                @endif
                <form action="login" method="POST">
                    @csrf
                    <div class="form-control">
                    <label class="label">
                        <span class="" for="email">Email</span>
                    </label>
                    <input type="email" name="email" id="email" placeholder="email" class="input input-bordered @error('email') @enderror"  autofocus required value="{{ old ('email') }}"/>

                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    </div>
                    <div class="form-control">
                    <label class="label" for="password">
                        <span class="" name="password" id="password" required>Password</span>
                    </label>
                    <input type="password" name="password" placeholder="password" class="input input-bordered" />
                    </div>
                    <div class="form-control mt-6 w-full">
                    <button type="submit" class="btn btn-active btn-success">Login</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  </form>
<script src="{{ asset('js/index.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    const x = document.querySelector('.alert');
        const y= document.querySelector('.btn-sm');
        y.addEventListener('click', () => x.remove());
    </script>
</body>
</html>
