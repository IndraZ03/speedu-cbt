<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'App' }} - Edit Kode Promo</title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Master Data</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><Link href="/admin/promo-codes">Kode Promo</Link></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.error" class="alert alert-danger border-0 alert-dismissible fade show">
                        <div v-html="$page.props.session.error"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card border-top border-0 border-3 border-primary">
                        <div class="card-header">
                            <div class="d-lg-flex align-items-center">
                                <h5 class="mb-0">Edit Kode Promo: {{ promoCode.code }}</h5>
                                <div class="ms-auto">
                                    <Link href="/admin/promo-codes" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-arrow-back"></i> Kembali
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-3">
                                <i class="bx bx-info-circle"></i> 
                                Kode ini sudah digunakan <strong>{{ promoCode.used_count }}</strong> kali.
                            </div>

                            <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kode Promo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="form.code" 
                                            :class="{ 'is-invalid': errors.code }" placeholder="Contoh: DISKON50" 
                                            @input="form.code = form.code.toUpperCase()">
                                        <div class="invalid-feedback" v-if="errors.code">{{ errors.code }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Promo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="form.name" 
                                            :class="{ 'is-invalid': errors.name }" placeholder="Contoh: Diskon Akhir Tahun">
                                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name }}</div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" v-model="form.description" rows="2" 
                                        placeholder="Deskripsi promo (opsional)"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tipe Diskon <span class="text-danger">*</span></label>
                                        <select class="form-select" v-model="form.discount_type" :class="{ 'is-invalid': errors.discount_type }">
                                            <option value="percentage">Persentase (%)</option>
                                            <option value="fixed">Nominal Tetap (Rp)</option>
                                        </select>
                                        <div class="invalid-feedback" v-if="errors.discount_type">{{ errors.discount_type }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nilai Diskon <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" v-if="form.discount_type === 'fixed'">Rp</span>
                                            <input type="number" class="form-control" v-model="form.discount_value" 
                                                :class="{ 'is-invalid': errors.discount_value }" min="0" step="0.01">
                                            <span class="input-group-text" v-if="form.discount_type === 'percentage'">%</span>
                                        </div>
                                        <div class="invalid-feedback" v-if="errors.discount_value">{{ errors.discount_value }}</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Minimal Pembelian</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" v-model="form.min_purchase" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" v-if="form.discount_type === 'percentage'">
                                        <label class="form-label">Maksimal Diskon</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" v-model="form.max_discount" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Batas Penggunaan Total</label>
                                        <input type="number" class="form-control" v-model="form.usage_limit" min="1">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Batas Penggunaan Per User <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" v-model="form.usage_limit_per_user" 
                                            :class="{ 'is-invalid': errors.usage_limit_per_user }" min="1">
                                        <div class="invalid-feedback" v-if="errors.usage_limit_per_user">{{ errors.usage_limit_per_user }}</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" v-model="form.valid_from">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Berakhir</label>
                                        <input type="date" class="form-control" v-model="form.valid_until">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" v-model="form.is_active" id="isActive">
                                        <label class="form-check-label" for="isActive">Aktifkan Kode Promo</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                                        <span v-if="isSubmitting">
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                            Menyimpan...
                                        </span>
                                        <span v-else><i class="bx bx-save"></i> Update</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from '../../../Layouts/Layout.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, reactive } from 'vue';

export default {
    layout: LayoutAdmin,
    components: {
        Link,
        Head
    },
    props: {
        errors: Object,
        promoCode: Object
    },
    setup(props) {
        const isSubmitting = ref(false);

        const form = reactive({
            code: props.promoCode.code,
            name: props.promoCode.name,
            description: props.promoCode.description || '',
            discount_type: props.promoCode.discount_type,
            discount_value: props.promoCode.discount_value,
            min_purchase: props.promoCode.min_purchase,
            max_discount: props.promoCode.max_discount,
            usage_limit: props.promoCode.usage_limit,
            usage_limit_per_user: props.promoCode.usage_limit_per_user,
            valid_from: props.promoCode.valid_from,
            valid_until: props.promoCode.valid_until,
            is_active: props.promoCode.is_active
        });

        const submit = () => {
            isSubmitting.value = true;
            Inertia.put(`/admin/promo-codes/${props.promoCode.id}`, form, {
                onFinish: () => {
                    isSubmitting.value = false;
                }
            });
        };

        return {
            form,
            submit,
            isSubmitting
        };
    }
};
</script>
