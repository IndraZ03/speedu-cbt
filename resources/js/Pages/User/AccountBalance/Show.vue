<template>
    <Head>
        <title>
            {{
                $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu"
            }}
            - Transaksi
        </title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div
                class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"
            >
                <div class="breadcrumb-title pe-3">Transaksi</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"
                                    ><i class="bx bx-home-alt"></i
                                ></a>
                            </li>
                            <li
                                class="breadcrumb-item active"
                                aria-current="page"
                            >
                                Detail Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-lg-12">
                    <div
                        v-if="$page.props.session.failed"
                        class="alert alert-danger border-0 alert-dismissible fade show"
                    >
                        <div v-html="$page.props.session.failed"></div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div
                        v-if="$page.props.session.error"
                        class="alert alert-danger border-0 alert-dismissible fade show"
                    >
                        <div v-html="$page.props.session.error"></div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div
                        v-if="$page.props.session.success"
                        class="alert alert-success border-0 alert-dismissible fade show"
                    >
                        <div v-html="$page.props.session.success"></div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div
                        class="card border-top border-0 border-3 border-primary"
                    >
                        <div class="card-header">
                            <div class="d-lg-flex align-items-center">
                                <div class="ms-auto">
                                    <Link
                                        v-if="
                                            transaction.transaction_status ==
                                                'pending' &&
                                            transaction.payment_method ==
                                                'manual_transfer'
                                        "
                                        :href="`/user/account-balances/${transaction.id}/payment-confirmations`"
                                        class="btn btn-danger btn-sm mt-lg-0 mx-1"
                                        >Konfirmasi Pembayaran</Link
                                    >
                                    <Link
                                        :href="`/user/account-balances`"
                                        class="btn btn-primary btn-sm mt-lg-0"
                                    >
                                        Kembali
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="mb-3">Data Pembeli</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Nama Lengkap</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="transaction.user.name"
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Email</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="transaction.user.email"
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Nomor Telepon (Whatsapp)</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="
                                            transaction.user.student &&
                                            transaction.user.student
                                                .phone_number
                                                ? transaction.user.student
                                                      .phone_number
                                                : '-'
                                        "
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>

                            <h5 class="mb-3">Detail Transaksi</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Kode Transaksi</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="transaction.code"
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Tanggal Transaksi</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="transaction.created_at"
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Deskripsi Transaksi</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="transaction.description"
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Metode Pembayaran</label
                                >
                                <div class="col-sm-9">
                                    <select
                                        class="form-select"
                                        disabled
                                        style="background-color: #fff"
                                    >
                                        <option
                                            value="manual_transfer"
                                            :selected="
                                                transaction.payment_method ==
                                                'manual_transfer'
                                            "
                                        >
                                            Transfer Manual (Konfirmasi
                                            Pembayaran)
                                        </option>
                                        <option
                                            value="automatic_transfer_midtrans"
                                            :selected="
                                                transaction.payment_method ==
                                                'automatic_transfer_midtrans'
                                            "
                                        >
                                            Transfer Otomatis
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Total Transaksi</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="
                                            formatPrice(
                                                transaction.top_up_balance
                                            )
                                        "
                                        disabled
                                        style="background-color: #fff"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"
                                    >Status Transaksi</label
                                >
                                <div class="col-sm-9">
                                    <span
                                        class="fw-bold"
                                        v-if="
                                            transaction.transaction_status ==
                                            'pending'
                                        "
                                        >Pending - Belum melakukan
                                        pembayaran</span
                                    >
                                    <span
                                        class="fw-bold"
                                        v-if="
                                            transaction.transaction_status ==
                                            'paid'
                                        "
                                        >Telah melakukan pembayaran</span
                                    >
                                    <span
                                        class="fw-bold"
                                        v-if="
                                            transaction.transaction_status ==
                                            'failed'
                                        "
                                        >Transaksi Gagal</span
                                    >
                                    <span
                                        class="fw-bold"
                                        v-if="
                                            transaction.transaction_status ==
                                            'done'
                                        "
                                        >Transaksi Selesai</span
                                    >
                                    <span
                                        class="fw-bold"
                                        v-if="
                                            transaction.transaction_status ==
                                            'expired'
                                        "
                                        >Transaksi Kadaluarsa</span
                                    >
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-if="
                                    transaction.payment_method ==
                                        'automatic_transfer_midtrans' &&
                                    transaction.transaction_status == 'pending'
                                "
                            >
                                <label class="col-sm-3 col-form-label"
                                    >Action</label
                                >
                                <div class="col-sm-9">
                                    <button
                                        @click="pay"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Bayar Transaksi Sekarang
                                    </button>
                                </div>
                            </div>
                            <div
                                v-if="
                                    transaction.payment_method ==
                                        'manual_transfer' &&
                                    payment_confirmation !== null
                                "
                            >
                                <h5 class="mb-3">Data Konfirmasi Pembayaran</h5>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                        >Nama Pengirim Transfer</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="
                                                payment_confirmation.rekening_name
                                            "
                                            disabled
                                            style="background-color: #fff"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                        >Di Transfer Ke Rekening</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="
                                                payment_confirmation.bank
                                                    .bank_name +
                                                ' - ' +
                                                payment_confirmation.bank
                                                    .rekening_number +
                                                ' - ' +
                                                payment_confirmation.bank
                                                    .rekening_name
                                            "
                                            disabled
                                            style="background-color: #fff"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                        >Tanggal Transfer</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="
                                                payment_confirmation.transfer_date
                                            "
                                            disabled
                                            style="background-color: #fff"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                        >Jumlah Transfer</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="
                                                formatPrice(
                                                    payment_confirmation.total_payment
                                                )
                                            "
                                            disabled
                                            style="background-color: #fff"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                        >Bukti Transfer</label
                                    >
                                    <div class="col-sm-9">
                                        <img
                                            v-bind:src="
                                                '/storage/upload_files/payment_confirmation/' +
                                                payment_confirmation.file
                                            "
                                            style="width: 300px"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="row"
                                v-if="
                                    transaction.payment_method ==
                                        'manual_transfer' &&
                                    transaction.transaction_status == 'pending'
                                "
                            >
                                <div class="col-lg-12">
                                    <h6 class="text-center">
                                        Silakan lakukan pembayaran melalui
                                        rekening berikut ini dan lakukan
                                        konfirmasi
                                    </h6>
                                    <br />
                                    <div
                                        class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4"
                                    >
                                        <div class="col" v-for="bank in banks">
                                            <div class="card h-100 shadow-sm">
                                                <div
                                                    class="card-body d-flex flex-column p-4"
                                                >
                                                    <div
                                                        class="text-center mb-4"
                                                    >
                                                        <img
                                                            v-bind:src="
                                                                '/storage/upload_files/banks/' +
                                                                bank.image
                                                            "
                                                            class="img-fluid"
                                                            style="
                                                                max-height: 75px;
                                                                max-width: 125px;
                                                                object-fit: contain;
                                                            "
                                                            :alt="
                                                                bank.bank_name
                                                            "
                                                        />
                                                    </div>
                                                    <div
                                                        class="text-center mt-auto"
                                                    >
                                                        <h6
                                                            class="card-title mb-3 fw-bold"
                                                        >
                                                            {{ bank.bank_name }}
                                                        </h6>
                                                        <p
                                                            class="card-text mb-2 text-muted"
                                                        >
                                                            {{
                                                                bank.rekening_number
                                                            }}
                                                        </p>
                                                        <p
                                                            class="card-text mb-0 fw-semibold"
                                                        >
                                                            {{
                                                                bank.rekening_name
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutAdmin from "../../../Layouts/Layout.vue";

// import Link
import { Link } from "@inertiajs/inertia-vue3";

//import reactive
import { reactive } from "vue";

// import Head from Inertia
import { Head } from "@inertiajs/inertia-vue3";

// import Swal
import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

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
        transaction: Object,
        banks: Object,
        payment_confirmation: Object,
    },
    setup(props) {
        const form = reactive({
            payment_method: "",
        });

        // submit method
        const submit = () => {
            // send data to server
            Inertia.post(
                `/user/vouchers/${props.voucher.id}/buy`,
                {
                    // data
                    payment_method: form.payment_method,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Silakan Lakukan Pembayaran",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    },
                }
            );
        };

        const pay = () => {
            window.snap.pay(props.transaction.snap_token, {
                onSuccess: () => {
                    Inertia.post(`/user/account-balances/pay`, {
                        transaction_id: props.transaction.id,
                        payment_method: "automatic_transfer_midtrans",
                    });
                },
                onPending: () => {
                    this.$inertia.reload();
                },
                onError: () => {
                    this.$inertia.visit($page.props.setting.app_url);
                },
            });
        };

        // return form state and submit method
        return {
            form,
            submit,
            pay,
        };
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return "Rp." + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
    },
};
</script>
