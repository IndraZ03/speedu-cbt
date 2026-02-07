<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Program</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Program</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Program</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex flex-wrap align-items-center mb-4 gap-3">
                        <form @submit.prevent="handleSearch" class="d-flex gap-2">
                            <div class="position-relative">
                                <input type="text" v-model="search" class="form-control ps-5 radius-20"
                                    placeholder="Cari program..." size="30" maxlength="100">
                                <span class="position-absolute top-50 product-show translate-middle-y">
                                    <i class="bx bx-search"></i>
                                </span>
                            </div>
                            <select v-model="categoryFilter" class="form-select" style="width: auto;" @change="handleSearch">
                                <option value="">Semua Kategori</option>
                                <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
                            </select>
                        </form>
                        <div class="ms-auto">
                            <Link href="/admin/programs/create" class="btn btn-primary btn-sm mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i> Tambah Program
                            </Link>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Program</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Promo</th>
                                    <th>Status</th>
                                    <th>Urutan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(program, index) in programs.data" :key="program.id">
                                    <td>{{ ++index + (programs.current_page - 1) * programs.per_page }}</td>
                                    <td>
                                        <div>{{ program.name }}</div>
                                        <span :class="`badge bg-${program.badge_color}`" v-if="program.badge_text">
                                            {{ program.badge_text }}
                                        </span>
                                    </td>
                                    <td>{{ program.category }}</td>
                                    <td class="text-muted text-decoration-line-through">
                                        Rp {{ formatNumber(program.original_price) }}
                                    </td>
                                    <td class="fw-bold text-success">
                                        Rp {{ formatNumber(program.promo_price) }}
                                    </td>
                                    <td>
                                        <span :class="program.is_active ? 'badge bg-success' : 'badge bg-secondary'">
                                            {{ program.is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                        <span v-if="program.is_featured" class="badge bg-warning ms-1">Featured</span>
                                    </td>
                                    <td>{{ program.order }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="#" @click.prevent="duplicate(program.id)" class="ms-1" title="Duplikasi">
                                                <i class='bx bx-copy'></i>
                                            </a>
                                            <Link :href="`/admin/programs/${program.id}/edit`" class="ms-1" title="Edit">
                                                <i class='bx bxs-edit'></i>
                                            </Link>
                                            <a href="#" @click.prevent="destroy(program.id)" class="ms-1" title="Hapus">
                                                <i class="bx bxs-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="8" v-if="!programs.data.length">Data Tidak Tersedia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Pagination :links="programs.links" align="end" />
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
        programs: Object,
        categories: Array,
        filters: Object
    },
    setup(props) {
        const search = ref(props.filters?.search || '');
        const categoryFilter = ref(props.filters?.category || '');

        const handleSearch = () => {
            Inertia.get('/admin/programs', {
                search: search.value,
                category: categoryFilter.value,
            });
        };

        const formatNumber = (num) => {
            return new Intl.NumberFormat('id-ID').format(num);
        };

        const destroy = (id) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Program akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/programs/${id}`);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Program Berhasil Dihapus!',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    });
                }
            });
        };

        const duplicate = (id) => {
            Swal.fire({
                title: 'Duplikasi Program?',
                text: "Program akan diduplikasi dengan semua pengaturannya",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Duplikasi'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.post(`/admin/programs/${id}/duplicate`);
                }
            });
        };

        return { search, categoryFilter, handleSearch, formatNumber, destroy, duplicate };
    }
};
</script>
