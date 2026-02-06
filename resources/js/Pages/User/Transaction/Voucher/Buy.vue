<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Pembelian Voucher</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Voucher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pembelian Voucher</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.failed" class="alert alert-danger border-0 alert-dismissible fade show">
                        <div v-html="$page.props.session.failed"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div v-if="$page.props.session.error" class="alert alert-danger border-0 alert-dismissible fade show">
                        <div v-html="$page.props.session.error"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div v-if="$page.props.session.success" class="alert alert-success border-0 alert-dismissible fade show">
                        <div v-html="$page.props.session.success"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form @submit.prevent="submit">
                        <div class="card border-top border-0 border-3 border-primary">
                            <div class="card-header">
                                <div class="d-lg-flex align-items-center">
                                    <h6>Detail Pembelian Voucher</h6>
                                    <div class="ms-auto">
                                        <Link :href="`/user/vouchers?category_id=${voucher.category_id}`" class="btn btn-primary btn-sm">Kembali</Link>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" :value="voucher.category.name" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Sub Kategori</label>
                                    <div class="col-sm-9">
                                        <div v-if="voucher.sub_categories.length">
                                            <div v-for="(sub_category, index) in voucher.sub_categories" :key="index" style="display: inline;">
                                                <span class="badge bg-primary m-1">{{ sub_category.name }}</span>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <span class="badge bg-primary m-1">Seluruh Kategori Peminatan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Voucher</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" :value="voucher.name" disabled style="background-color: #fff;">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Masa Aktif</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" :value="voucher.active_period + ' Bulan'" disabled style="background-color: #fff;">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Harga</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" :value="formatPrice(voucher.price_after_discount)" disabled style="background-color: #fff;">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Kategori Member</label>
                                    <div class="col-sm-9">
                                        <div v-if="voucher.member_categories">
                                            <h6>
                                                <div v-for="(member, index) in voucher.member_categories" :key="index" style="display: inline;">
                                                    <span class="badge bg-success m-1">{{ member }}</span>
                                                </div>
                                            </h6>
                                        </div>
                                        <div v-else>
                                            <h6><span class="badge bg-success m-1">Akses Untuk Seluruh Tipe Member</span></h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kode Promo Section -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Kode Promo</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="form.promo_code" 
                                                placeholder="Masukkan kode promo (opsional)" 
                                                @input="form.promo_code = form.promo_code.toUpperCase()"
                                                :class="{ 'is-invalid': promoError, 'is-valid': promoValid }">
                                            <button type="button" class="btn btn-outline-primary" @click="validatePromoCode" :disabled="isValidating || !form.promo_code">
                                                <span v-if="isValidating">
                                                    <span class="spinner-border spinner-border-sm"></span>
                                                </span>
                                                <span v-else>Terapkan</span>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" @click="removePromoCode" v-if="promoValid">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                        <div v-if="promoError" class="text-danger small mt-1">{{ promoError }}</div>
                                        <div v-if="promoValid" class="text-success small mt-1">
                                            <i class="bx bx-check-circle"></i> {{ promoMessage }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Ringkasan Harga -->
                                <div class="row mb-3" v-if="discountAmount > 0">
                                    <label class="col-sm-3 col-form-label">Diskon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control text-success" :value="'- ' + formatPrice(discountAmount)" disabled style="background-color: #d4edda;">
                                    </div>
                                </div>
                                <div class="row mb-3" v-if="discountAmount > 0">
                                    <label class="col-sm-3 col-form-label fw-bold">Total Bayar</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control fw-bold" :value="formatPrice(finalAmount)" disabled style="background-color: #fff; font-size: 1.2em;">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
                                    <div class="col-sm-9">
                                        <select v-model="form.payment_method" :class="{ 'is-invalid': errors.payment_method }" class="form-select">
                                            <option value="">[ Pilih Metode Pembayaran ]</option>
                                            <option v-for="paymentMethod in $page.props.setting.payment_methods" :value="paymentMethod.code">{{ paymentMethod.description }}</option>
                                        </select>
                                        <div v-if="errors.payment_method" class="invalid-feedback">
                                            {{ errors.payment_method }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button class="btn btn-primary btn-sm px-4" :disabled="isSubmitting">
                                                <span v-if="isSubmitting">
                                                    <span class="spinner-border spinner-border-sm"></span> Memproses...
                                                </span>
                                                <span v-else>Lanjutkan ke pembayaran</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutAdmin from '../../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    //import reactive
    import { reactive, ref, computed } from 'vue';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';

    // import Swal
    import Swal from 'sweetalert2';

    import { Inertia } from '@inertiajs/inertia';
    import axios from 'axios';

    export default {
        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Link,
            Head,
        },

        //props
        props: {
            errors: Object,
            voucher: Object,
        },
        setup(props) {
            const form = reactive({
                payment_method: '',
                promo_code: '',
            });

            const isValidating = ref(false);
            const isSubmitting = ref(false);
            const promoValid = ref(false);
            const promoError = ref('');
            const promoMessage = ref('');
            const discountAmount = ref(0);

            const finalAmount = computed(() => {
                return props.voucher.price_after_discount - discountAmount.value;
            });

            const validatePromoCode = async () => {
                if (!form.promo_code) return;
                
                isValidating.value = true;
                promoError.value = '';
                promoValid.value = false;
                
                try {
                    const response = await axios.post('/api/promo-code/validate', {
                        code: form.promo_code,
                        amount: props.voucher.price_after_discount
                    });
                    
                    if (response.data.valid) {
                        promoValid.value = true;
                        discountAmount.value = response.data.discount_amount;
                        promoMessage.value = `Kode promo berhasil! Diskon ${response.data.promo_code.discount_type === 'percentage' 
                            ? response.data.promo_code.discount_value + '%' 
                            : 'Rp ' + new Intl.NumberFormat('id-ID').format(response.data.promo_code.discount_value)}`;
                    }
                } catch (error) {
                    promoError.value = error.response?.data?.message || 'Terjadi kesalahan saat memvalidasi kode promo.';
                    discountAmount.value = 0;
                } finally {
                    isValidating.value = false;
                }
            };

            const removePromoCode = () => {
                form.promo_code = '';
                promoValid.value = false;
                promoError.value = '';
                promoMessage.value = '';
                discountAmount.value = 0;
            };

            // submit method
            const submit = () => {
                isSubmitting.value = true;
                // send data to server
                Inertia.post(`/user/vouchers/${props.voucher.id}/buy`, {
                    // data
                    payment_method: form.payment_method,
                    promo_code: promoValid.value ? form.promo_code : null,
                }, {
                    onFinish: () => {
                        isSubmitting.value = false;
                    }
                });
            }

            // return form state and submit method
            return {
                form,
                submit,
                isValidating,
                isSubmitting,
                promoValid,
                promoError,
                promoMessage,
                discountAmount,
                finalAmount,
                validatePromoCode,
                removePromoCode,
            }
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return 'Rp.' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>
