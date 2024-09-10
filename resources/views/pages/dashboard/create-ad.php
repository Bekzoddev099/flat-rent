<?php

declare(strict_types=1);
loadPartials(path: 'header', loadFromPublic: false);
/**
 * @var $ad
 * @var $branches
 * @var $statuses
 */


$uri = explode('/', $_SERVER['REQUEST_URI']);
if (in_array('create', $uri)) {
    $action = '/ads/create';
    $ad = null;
} else {
    $action = "/ads/update/$ad->id";
}
?>
    <div class="page-wrapper toggled">
        <?php loadPartials('sidebar', loadFromPublic: false) ?>
        <!-- Start Page Content -->
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <?php loadPartials('top-header', loadFromPublic: false) ?>


            <div class="container-fluid relative px-3">
                <div class="layout-specing">
                    <!-- Start Content -->
                    <div class="md:flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Add Property</h5>

                        <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                            <li class="inline-block capitalize text-[16px] font-medium duration-500 dark:text-white/70 hover:text-green-600 dark:hover:text-white">
                                <a href="index.html">Hously</a></li>
                            <li class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                                <i class="mdi mdi-chevron-right"></i></li>
                            <li class="inline-block capitalize text-[16px] font-medium text-green-600 dark:text-white"
                                aria-current="page">Add Property
                            </li>
                        </ul>
                    </div>

                    <div class="container relative">
                        <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mt-6">
                            <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                                <div>
                                    <p class="font-medium mb-4">Upload your property image here, Please click "Upload
                                        Image" Button.</p>
                                    <div class="preview-box flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small w-auto max-h-60">
                                        Supports JPG, PNG and MP4 videos. Max file size : 10MB.
                                    </div>
                                    <input form="ads-create" type="file" id="input-file" name="image" accept="image/*"
                                           onchange={handleChange()} hidden>
                                    <label class="btn-upload btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-6 cursor-pointer"
                                           for="input-file">Upload Image</label>
                                </div>
                            </div>

                            <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                                <form id="ads-create" action="<?= $action ?>" method="post"
                                      enctype="multipart/form-data">
                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="col-span-12">
                                            <input type="hidden" name="_method" value="patch">
                                            <label for="title" class="font-medium">Sarlavha</label>
                                            <input name="title" id="title" type="text" class="form-input mt-2"
                                                   placeholder="Sarlavha" value="<?= $ad?->title ?>">
                                        </div>

                                        <div class="md:col-span-4 col-span-12">
                                            <label for="description" class="font-medium">Ta'rif</label>
                                            <div class="form-icon relative mt-2">
                                                <i class="mdi mdi-arrow-expand-all absolute top-2 start-4 text-green-600"></i>
                                                <input name="description" id="description" class="form-input ps-11"
                                                       placeholder="E'lon bo'yicha ta'rif...">
                                                    <?= $ad?->description ?>
                                                </input>
                                            </div>
                                        </div>

                                        <div class="md:col-span-4 col-span-12 hidden">
                                            <div class="form-icon relative mt-2">
                                                <input name="user" value="5" type="number" class="form-input ps-11">
                                            </div>
                                        </div>
                                        <div class="md:col-span-4 col-span-12 hidden">
                                            <div class="form-icon relative mt-2">
                                                <input name="status_id" value="1" type="number"
                                                       class="form-input ps-11">
                                            </div>
                                        </div>

                                        <div class="md:col-span-4 col-span-12 hidden">
                                            <div class="form-icon relative mt-2">
                                                <input name="branch" value="1" type="number" class="form-input ps-11">
                                            </div>
                                        </div>

                                        <div class="md:col-span-4 col-span-12">
                                            <label for="address" class="font-medium">Manzil</label>
                                            <input name="address" id="address" type="text" class="form-input mt-2"
                                                   placeholder="Manzil:" value="<?= $ad?->address ?>">
                                        </div>
                                        <div class="col-span-12">
                                            <label for="price" class="font-medium">Narxi:</label>
                                            <div class="form-icon relative mt-2">
                                                <i class="mdi mdi-currency-usd absolute top-2 start-4 text-green-600"></i>
                                                <input name="price" id="price" type="number" class="form-input ps-11"
                                                       placeholder="Narxi($) :" value="<?= $ad?->price ?>">
                                            </div>
                                        </div>
                                        <div class="col-span-12">
                                            <label for="rooms" class="font-medium">Xonalar:</label>
                                            <div class="form-icon relative mt-2">
                                                <input name="rooms" id="rooms" type="number" class="form-input ps-11"
                                                       placeholder="Xonalar :" value="<?= $ad?->rooms ?>">
                                            </div>
                                        </div>
                                        <div class="md:col-span-4 col-span-12">
                                            <label for="branch" class="font-medium">Fillial</label>

                                            <div class="form-icon relative mt-2">
                                                <select id="branch" name="branch_id" class="form-input ps-11">
                                                    <?php
                                                    foreach ($branches as $branch):
                                                        echo '<option value="' . $branch->id . '">' . $branch->name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="md:col-span-4 col-span-12">
                                            <label for="branch2" class="font-medium">Status</label>
                                            <select name="status_id" id="branch2" class="form-input ps-11 mt-2" style="width: 150px;">
                                                <?php foreach ($statuses as $status) : ?>
                                                    <option value="<?= $status->id; ?>">
                                                        <?php echo $status->name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" id="submit"
                                            class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-5">
                                        Saqlash
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Content -->
                </div>
            </div><!--end container-->

            <!-- Footer Start -->
            <footer class="shadow dark:shadow-gray-700 bg-white dark:bg-slate-900 px-6 py-4">
                <div class="container-fluid">
                    <div class="grid grid-cols-1">
                        <div class="sm:text-start text-center mx-md-2">
                            <p class="mb-0 text-slate-400">©
                                <script>document.write(new Date().getFullYear())</script>
                                NTRA. Design with <i class="mdi mdi-heart text-red-600"></i> by PHP N1 group.
                            </p>
                        </div><!--end col-->
                    </div><!--end grid-->
                </div><!--end container-->
            </footer><!--end footer-->
            <!-- End -->
        </main>
        <!--End page-content" -->
    </div>
    <script>
        const handleChange = () => {
            const fileUploader = document.querySelector('#input-file');
            const getFile = fileUploader.files
            if (getFile.length !== 0) {
                const uploadedFile = getFile[0];
                readFile(uploadedFile);
            }
        }

        const readFile = (uploadedFile) => {
            if (uploadedFile) {
                const reader = new FileReader();
                reader.onload = () => {
                    const parent = document.querySelector('.preview-box');
                    parent.innerHTML = `<img class="preview-content" src=${reader.result} />`;
                };

                reader.readAsDataURL(uploadedFile);
            }
        };
    </script>


<?php
loadPartials(path: 'footer', loadFromPublic: false);
?>