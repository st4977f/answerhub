<body>
    <main>
        <div class="container">
            <section class="vh-100">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 text-black">

                            <div class="px-4">
                                <img src="images\University-of-Greenwich.svg" alt="Greenwich Logo" class="mr-5">
                            </div>

                            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                                <form action="includes/process_simple" method="post" style="width: 23rem;">
                                    <h3 class="fw-normal pb-1" style="letter-spacing: 1px;">SIGN UP</h3>
                                    <p class="pb-2">Don't have an account yet? Sign up here!</p>
                                    
                                    <input type="text" name="uid" placeholder="Username" required
                                        class="form-control form-control-lg form-outline mb-3 mt-3" 
                                        maxlength="50" pattern="[a-zA-Z0-9_]{3,}" 
                                        title="Username must be at least 3 characters and contain only letters, numbers, and underscores" />

                                    <input type="password" name="pwd" placeholder="Password" required
                                        class="form-control form-control-lg form-outline mb-3" 
                                        minlength="6" maxlength="255"
                                        title="Password must be at least 6 characters long" />

                                    <input type="email" name="email" placeholder="E-mail" required
                                        class="form-control form-control-lg form-outline mb-3" 
                                        maxlength="100" />

                                    <button class="btn btn-info btn-lg btn-block mb-3" name="submit"
                                        type="submit">Sign Up</button>
                                    
                                    <p>Have an account already? <a href="login" class="link-info">Login here</a></p>

                                </form>

                            </div>

                        </div>
                        <div class="col-sm-6 px-0 d-none d-sm-block" style="overflow: hidden; height: 100vh;">
                            <img src="images\registration_image.jpg" alt="Registration image" class="w-100 h-100"
                                style="object-fit: cover; object-position: left;">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
