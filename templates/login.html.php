<body>
    <main>
        <div class="container">
            <section class="vh-100" style="overflow: hidden;">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col-sm-6 px-0 d-none d-sm-block" style="overflow: hidden;">
                            <img src="images\login_image.jpg" alt="Login image" class="w-100 h-100"
                                style="object-fit: cover; object-position: center;">
                        </div>
                        <div class="col-sm-6 text-black">

                            <div class="px-4">
                                <img src="images\University-of-Greenwich.svg" alt="Greenwich Logo" class="mr-5">
                            </div>

                            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                                <form action="includes/process_simple" method="post" style="width: 23rem;">

                                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="uid" placeholder="Username"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="pwd" placeholder="Password"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-info btn-lg btn-block" type="submit" 
                                            name="login">Login</button>
                                    </div>

                                    <p class="small mb-4 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a>
                                    </p>
                                    <p>Don't have an account? <a href="registration" class="link-info">Register
                                            here</a></p>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
