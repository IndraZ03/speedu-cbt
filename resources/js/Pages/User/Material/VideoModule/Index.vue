<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Video Pembelajaran</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Video Pembelajaran</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Video Pembelajaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr/>
            <div v-if="!categoryVideoModules.length">
                <div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
                    <div class="col">
                        <div class="card border-bottom border-3 border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center">Data Video Pembelajaran Belum Tersedia.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-for="category in categoryVideoModules">
                <!-- <h5 class="mb-3">Video Pembelajaran {{ category.name }}</h5> -->
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" v-for="videoModule in category.video_module">
                        <div class="card">
                            <span class="badge bg-danger" style="position:absolute; right:-15px; top:-15px; width:50px; height: 35px; font-size: 20px;">
                                <i class="fadeIn animated bx bx-book"></i>
                            </span>
                            <div class="card-body">
                                <div class="card-title mt-1">
                                    <h6 class="mb-0">{{ videoModule.title }}</h6>
                                </div>
                                <hr/>
                                <!-- <p class="card-text" style="min-height: 50px;">{{ videoModule.description }}</p> -->
                                <div class="text-center">
                                    <!-- <p>Kategori Member</p> -->
                                    <span v-if="videoModule.member_categories" v-for="member_categories in videoModule.member_categories" class="badge bg-success m-1">
                                        {{  member_categories  }}
                                    </span>
                                    <span v-else class="badge bg-success mb-0">Seluruh Member & Non Member</span>
                                </div>
                                <!-- <hr/> -->
                                <div class="text-center" style="margin-top: 3px;">
                                    <div v-if="checkMemberCategories(videoModule.category_id, videoModule.member_categories) == true">
                                        <a :href="videoModule.link" class="btn btn-primary btn-sm" target="_blank">Buka Video</a>
                                    </div>
                                    <div v-else>
                                        <Link :href="`/user/vouchers?category_id=${videoModule.category_id}`" class="btn btn-outline-primary btn-sm w-100">
                                            <div v-if="videoModule.member_categories.length == 1">
                                                Upgrade Ke
                                                <span v-for="memberCategories in videoModule.member_categories"> 
                                                    {{ memberCategories }}
                                                </span>
                                            </div>
                                            <div v-else>
                                                Upgrade Member
                                            </div>
                                        </Link> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    // Import komponen dan pustaka yang diperlukan
    import LayoutUser from '../../../../Layouts/Layout.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import { Head } from '@inertiajs/inertia-vue3';

    export default {
        // Menetapkan layout
        layout: LayoutUser,

        // Mendaftarkan komponen
        components: {
            Link,
            Head,
        },

        // Props yang diterima
        props: {
            categoryVideoModules: Array,
            userMemberCategories: Array,
        },
        
        data() {
            return {
                selectedVideoModule: null,
                videos: [
                    {
                        judul: "01 TIU : Deret",
                        youtube: "https://www.youtube.com/embed/xMOq5WQM10A",
                        idVideo: "exampleFullScreenModal"
                    },
                    {
                        judul: "02 TWK : Nasionalisme (Part 1)",
                        youtube: "https://www.youtube.com/embed/HPIuHZ0xyfQ",
                        idVideo: "exampleFullScreenModal2"
                    },
                    {
                        judul: "03 TWK : Nasionalisme (Part 2)",
                        youtube: "https://www.youtube.com/embed/oua7mWZphGc",
                        idVideo: "exampleFullScreenModal3"
                    },
                    {
                        judul: "04 TWK : Nasionalisme (Part 3)",
                        youtube: "https://www.youtube.com/embed/CP84rYOmB0s",
                        idVideo: "exampleFullScreenModal4"
                    },
                    {
                        judul: "05 TIU : Analitis",
                        youtube: "https://www.youtube.com/embed/VeCuOvkfnXk",
                        idVideo: "exampleFullScreenModal5"
                    },
                    {
                        judul: "06 TIU : Figural Analogi",
                        youtube: "https://www.youtube.com/embed/NS6dZ7tzXWQ",
                        idVideo: "exampleFullScreenModal6"
                    },
                    {
                        judul: "07 TIU : Kemampuan Verbal",
                        youtube: "https://www.youtube.com/embed/CoRRJy2Dkv8",
                        idVideo: "exampleFullScreenModal7"
                    },
                    {
                        judul: "08 TIU : Silogisme",
                        youtube: "https://www.youtube.com/embed/3jD0pUxGlN4",
                        idVideo: "exampleFullScreenModal8"
                    }
                ]
                };
            },
        computed: {
                jumlahData() {
                // Mengembalikan jumlah data dalam array videos
                return this.videos.length;
                }
            },

        methods: {
            // Memeriksa kategori member
            checkMemberCategories(category_id, categories) {
                var userMemberCategories = this.userMemberCategories.filter(function(userMemberCategory) {
                    return userMemberCategory.category_id === category_id;
                });

                if (categories) {
                    for (const entry of userMemberCategories) {
                        if (entry.member_categories.some(category => categories.includes(category))) {
                            return true;
                        }
                    }
                    return false;
                } else {
                    return true;
                }
            },

            // Berhenti memutar video
            stopVideo() {
                var iframe = document.getElementById("youtube-video");
                var iframeSrc = iframe.src;
                iframe.src = iframeSrc;
            },

            // Menutup modal video
            closeVideo() {
                this.stopVideo();
                window.location.reload(); // Memuat ulang halaman
            },

            // Membuka modal video
            openModal(videoModule) {
                this.selectedVideoModule = videoModule;
                $('#exampleFullScreenModal').modal('show'); // Menampilkan modal menggunakan jQuery
            },
            getClass(judul) {
                // Definisikan pilihan warna berdasarkan kondisi tertentu pada judul
                const colorOptions = {
                    'TIU': 'btn btn-sm btn-danger',
                    'TWK': 'btn btn-sm btn-primary',
                    'TKP': 'btn btn-sm btn-success',
                };

                // Cek setiap kondisi dan kembalikan warna yang sesuai
                for (const option in colorOptions) {
                    if (judul.includes(option)) {
                        return colorOptions[option];
                    }
                }

                // Jika tidak ada kondisi yang cocok, kembalikan kelas default
                return 'btn btn-sm btn-secondary';
            }
        }
    }
</script>
