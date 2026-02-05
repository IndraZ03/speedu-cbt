<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Testimoni</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Testimoni</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Testimoni</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <form @submit.prevent="handleSearch">
                            <div class="position-relative">
                                <input
                                    type="text"
                                    v-model="search"
                                    class="form-control ps-5 radius-20"
                                    placeholder="Cari Berdasarkan Nama...."
                                    size="40"
                                    maxlength="100"
                                >
                                <span class="position-absolute top-50 product-show translate-middle-y">
                                    <i class="bx bx-search"></i>
                                </span>
                            </div>
                        </form>
                        <div class="ms-auto">
                            <Link href="/admin/testimonials/create" class="btn btn-primary btn-sm mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i> Tambah Testimoni
                            </Link>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Posisi</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Urutan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(testimonial, index) in testimonials.data" :key="index">
                                    <td>{{ ++index + (testimonials.current_page - 1) * testimonials.per_page }}</td>
                                    <td>
                                        <img v-if="testimonial.photo" 
                                             :src="`/storage/upload_files/testimonials/${testimonial.photo}`" 
                                             alt="Foto" 
                                             class="rounded-circle" 
                                             width="40" 
                                             height="40"
                                             style="object-fit: cover;">
                                        <div v-else class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ testimonial.name.charAt(0).toUpperCase() }}
                                        </div>
                                    </td>
                                    <td>{{ testimonial.name }}</td>
                                    <td>{{ testimonial.position || '-' }}</td>
                                    <td>
                                        <span v-for="star in 5" :key="star">
                                            <i :class="star <= testimonial.rating ? 'bx bxs-star text-warning' : 'bx bx-star text-muted'"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <span :class="testimonial.is_active ? 'badge bg-success' : 'badge bg-secondary'">
                                            {{ testimonial.is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>{{ testimonial.order }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <Link :href="`/admin/testimonials/${testimonial.id}/edit`" class="ms-1">
                                                <i class='bx bxs-edit'></i>
                                            </Link>
                                            <a href="#" @click.prevent="destroy(testimonial.id)" class="ms-1">
                                                <i class="bx bxs-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="8" v-if="!testimonials.data.length">Data Tidak Tersedia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Pagination :links="testimonials.links" align="end" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from '../../../Layouts/Layout.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    layout: LayoutAdmin,
    components: { Link, Head, Pagination },
    props: {
        testimonials: Object,
        filters: Object
    },
    setup(props) {
        const search = ref(props.filters?.search || '');

        const handleSearch = () => {
            Inertia.get('/admin/testimonials', {
                search: search.value,
            });
        };

        const destroy = (id) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/testimonials/${id}`);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Testimoni Berhasil Dihapus!',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    });
                }
            });
        };

        return { search, handleSearch, destroy };
    }
};
</script>
