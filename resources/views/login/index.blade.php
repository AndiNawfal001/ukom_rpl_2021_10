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
            <div class="card flex-shrink-0 w-full max-w-sm shadow-lg bg-base-200">
                <div class="card-body w-full">
                    <div class="w-full text-center">
                        <img src="{{ asset('image/aa.png') }}" class="mx-auto w-14">
                        <h1 class="text-2xl font-light my-2 ">Sign in to MyStock</h1>
                    </div>
                <form action="login" method="POST">
                    @csrf
                    <div class="form-control">
                    <label class="label">
                        <span class="" for="email">Email</span>
                    </label>
                    <input type="email" name="email" id="email" placeholder="email" class="input input-bordered @error('email') @enderror"  autofocus required value="{{ old ('email') }}" autocomplete="off"/>

                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    </div>
                    <div class="form-control">
                    <label class="label" for="password">
                        <span class="" name="password" id="password" required>Password</span>
                    </label>
                    <input type="password" name="password" placeholder="password" class="input input-bordered" required/>
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
