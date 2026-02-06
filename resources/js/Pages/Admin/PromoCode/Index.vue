<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'App' }} - Kelola Kode Promo</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Master Data</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kode Promo</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.success" class="alert alert-success border-0 alert-dismissible fade show">
                        <div v-html="$page.props.session.success"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card border-top border-0 border-3 border-primary">
                        <div class="card-header">
                            <div class="d-lg-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Daftar Kode Promo</h5>
                                </div>
                                <div class="ms-auto">
                                    <Link href="/admin/promo-codes/create" class="btn btn-primary btn-sm mt-2 mt-lg-0">
                                        <i class="bx bx-plus"></i> Tambah Kode Promo
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Cari kode promo..." v-model="search" @keyup.enter="searchData">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" @click="searchData">Cari</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Diskon</th>
                                            <th>Penggunaan</th>
                                            <th>Valid</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="promoCodes.data.length === 0">
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                        <tr v-for="(promoCode, index) in promoCodes.data" :key="promoCode.id">
                                            <td>{{ promoCodes.from + index }}</td>
                                            <td><code class="fw-bold">{{ promoCode.code }}</code></td>
                                            <td>{{ promoCode.name }}</td>
                                            <td>
                                                <span v-if="promoCode.discount_type === 'percentage'" class="badge bg-info">
                                                    {{ promoCode.discount_value }}%
                                                </span>
                                                <span v-else class="badge bg-success">
                                                    Rp {{ formatPrice(promoCode.discount_value) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ promoCode.used_count }} / {{ promoCode.usage_limit || '∞' }}
                                            </td>
                                            <td>
                                                <small>
                                                    {{ promoCode.valid_from || '-' }} s/d {{ promoCode.valid_until || '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <span v-if="promoCode.is_active" class="badge bg-success">Aktif</span>
                                                <span v-else class="badge bg-secondary">Nonaktif</span>
                                            </td>
                                            <td>
                                                <Link :href="`/admin/promo-codes/${promoCode.id}/edit`" class="btn btn-warning btn-sm me-1">
                                                    <i class="bx bx-edit"></i>
                                                </Link>
                                                <button @click="deletePromoCode(promoCode.id)" class="btn btn-danger btn-sm">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :links="promoCodes.links" class="mt-3" />
                        </div>
                    </div>
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
    components: {
        Link,
        Head,
        Pagination
    },
    props: {
        promoCodes: Object,
        filters: Object
    },
    setup(props) {
        const search = ref(props.filters?.search || '');

        const searchData = () => {
            Inertia.get('/admin/promo-codes', { search: search.value }, { preserveState: true });
        };

        const deletePromoCode = (id) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Kode promo akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/promo-codes/${id}`);
                }
            });
        };

        const formatPrice = (value) => {
            return new Intl.NumberFormat('id-ID').format(value);
        };

        return {
            search,
            searchData,
            deletePromoCode,
            formatPrice
        };
    }
};
</script>
