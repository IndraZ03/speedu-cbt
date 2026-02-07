<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "SpeedU CBT" }} - Dashboard
        </title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Welcome Section -->
            <div class="welcome-section mb-4">
                <div class="welcome-card">
                    <div class="welcome-content">
                        <div class="welcome-text">
                            <h2 class="welcome-title">
                                Selamat Datang, <span class="user-name">{{ $page.props.auth.user.name }}!</span> 👋
                            </h2>
                            <p class="welcome-subtitle">
                                Siap untuk belajar hari ini? Pilih materi atau try out di bawah untuk memulai perjalanan suksesmu.
                            </p>
                        </div>
                        <div class="welcome-stats" v-if="$page.props.auth.user.member_type == 2">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bx bx-wallet"></i>
                                </div>
                                <div class="stat-info">
                                    <span class="stat-label">Saldo</span>
                                    <span class="stat-value">Rp {{ formatPrice($page.props.auth.user.account_balance) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-decoration">
                        <div class="floating-shape shape-1"></div>
                        <div class="floating-shape shape-2"></div>
                        <div class="floating-shape shape-3"></div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="section-header mb-3" v-if="$page.props.setting.purchase_type != 1">
                <h5 class="section-title">
                    <i class="bx bx-category-alt"></i>
                    Kategori Pembelajaran
                </h5>
            </div>

            <div class="categories-grid" v-if="$page.props.setting.purchase_type != 1">
                <div class="category-card-modern" 
                     v-for="(totalDataInCategory, index) in totalDataInCategories" 
                     :key="index">
                    <Link :href="`/user/exam-groups/${totalDataInCategory.id}/lesson-categories`">
                        <div class="category-card-inner" :class="getCategoryClass(index)">
                            <div class="category-icon">
                                <i class="bx bx-book-reader"></i>
                            </div>
                            <div class="category-info">
                                <h6 class="category-name">{{ totalDataInCategory.name }}</h6>
                                <div class="category-stats">
                                    <span class="stat-badge">
                                        <i class="bx bx-file"></i>
                                        {{ totalDataInCategory.exam_group_count }} Try Out
                                    </span>
                                </div>
                            </div>
                            <div class="category-arrow">
                                <i class="bx bx-chevron-right"></i>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Info Cards Row -->
            <div class="row mt-4">
                <!-- Announcements Card -->
                <div class="col-lg-6 mb-4">
                    <div class="info-card announcement-card">
                        <div class="info-card-header">
                            <div class="header-icon bg-gradient-success">
                                <i class="bx bx-bell"></i>
                            </div>
                            <h5 class="header-title">Pemberitahuan</h5>
                            <Link href="/user/announcements" class="view-all-link">
                                Lihat Semua <i class="bx bx-right-arrow-alt"></i>
                            </Link>
                        </div>
                        <div class="info-card-body">
                            <div v-if="!announcementSummaries.length" class="empty-state">
                                <i class="bx bx-bell-off"></i>
                                <p>Tidak ada pemberitahuan</p>
                            </div>
                            <div v-else class="announcement-list">
                                <div class="announcement-item" 
                                     v-for="(announcement, index) in announcementSummaries.slice(0, 5)" 
                                     :key="index">
                                    <div class="announcement-dot"></div>
                                    <Link :href="`/user/announcements/${announcement.id}`" class="announcement-link">
                                        {{ announcement.title }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction History Card -->
                <div class="col-lg-6 mb-4" v-if="$page.props.auth.user.member_type == 2">
                    <div class="info-card transaction-card">
                        <div class="info-card-header">
                            <div class="header-icon bg-gradient-info">
                                <i class="bx bx-receipt"></i>
                            </div>
                            <h5 class="header-title">Riwayat Pembelian</h5>
                            <Link href="/user/transactions" class="view-all-link">
                                Lihat Semua <i class="bx bx-right-arrow-alt"></i>
                            </Link>
                        </div>
                        <div class="info-card-body">
                            <div v-if="!transactions || transactions.length === 0" class="empty-state">
                                <i class="bx bx-cart"></i>
                                <p>Belum ada transaksi</p>
                            </div>
                            <div v-else class="transaction-list">
                                <div class="transaction-item" 
                                     v-for="(transaction, index) in transactions.slice(0, 5)" 
                                     :key="index">
                                    <div class="transaction-icon" :class="getTransactionStatusClass(transaction.transaction_status)">
                                        <i class="bx" :class="getTransactionIcon(transaction.transaction_status)"></i>
                                    </div>
                                    <div class="transaction-info">
                                        <span class="transaction-desc">{{ transaction.description }}</span>
                                        <span class="transaction-amount">Rp {{ formatPrice(transaction.total_payment) }}</span>
                                    </div>
                                    <span class="transaction-status" :class="getTransactionStatusClass(transaction.transaction_status)">
                                        {{ getTransactionStatusLabel(transaction.transaction_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Voucher Section -->
            <div class="voucher-section" v-if="vouchers && vouchers.length">
                <!-- Voucher Header with Filter -->
                <div class="voucher-header-section mb-4">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bx bx-gift"></i>
                            Paket Voucher Tersedia
                        </h5>
                    </div>
                    
                    <!-- Filter Section -->
                    <div class="voucher-filter-card">
                        <div class="filter-row">
                            <!-- Category Tabs -->
                            <div class="category-tabs">
                                <button 
                                    class="tab-btn" 
                                    :class="{ active: activeCategory === 'all' }"
                                    @click="activeCategory = 'all'">
                                    <i class="bx bx-grid-alt"></i> Semua
                                </button>
                                <button 
                                    class="tab-btn" 
                                    :class="{ active: activeCategory === 'promo' }"
                                    @click="activeCategory = 'promo'">
                                    <i class="bx bx-purchase-tag"></i> Promo
                                </button>
                                <button 
                                    class="tab-btn" 
                                    :class="{ active: activeCategory === 'skd' }"
                                    @click="activeCategory = 'skd'">
                                    <i class="bx bx-book"></i> SKD
                                </button>
                                <button 
                                    class="tab-btn" 
                                    :class="{ active: activeCategory === 'other' }"
                                    @click="activeCategory = 'other'">
                                    <i class="bx bx-package"></i> Seleksi Lanjutan Kedinasan
                                </button>
                            </div>
                        </div>
                        
                        <!-- Price Range Slider -->
                        <div class="price-filter">
                            <div class="price-filter-label">
                                <span>Filter Harga:</span>
                                <span class="price-range-display">
                                    Rp {{ formatPrice(priceRange[0]) }} - Rp {{ formatPrice(priceRange[1]) }}
                                </span>
                            </div>
                            <div class="price-slider-container">
                                <input 
                                    type="range" 
                                    class="price-slider"
                                    :min="0" 
                                    :max="maxPrice" 
                                    :step="10000"
                                    v-model="priceRange[0]"
                                    @input="updateMinPrice">
                                <input 
                                    type="range" 
                                    class="price-slider"
                                    :min="0" 
                                    :max="maxPrice" 
                                    :step="10000"
                                    v-model="priceRange[1]"
                                    @input="updateMaxPrice">
                                <div class="slider-track" :style="sliderTrackStyle"></div>
                            </div>
                            <div class="price-labels">
                                <span>Rp 0</span>
                                <span>Rp {{ formatPrice(maxPrice) }}</span>
                            </div>
                        </div>
                        
                        <div class="filter-result-count">
                            <span class="result-badge">{{ filteredVouchers.length }} paket ditemukan</span>
                        </div>
                    </div>
                </div>

                <!-- Promo Section (Harga 0-5000) -->
                <div class="voucher-category-section" v-if="promoVouchers.length && activeCategory !== 'skd' && activeCategory !== 'other'">
                    <div class="category-section-header">
                        <div class="category-badge promo-badge">
                            <i class="bx bx-purchase-tag"></i>
                            PROMO SPESIAL
                        </div>
                        <span class="category-subtitle">Harga mulai dari Rp 0 - Rp 5.000</span>
                    </div>
                    <div class="voucher-grid">
                        <div class="voucher-card-modern" v-for="(voucher, index) in displayedPromoVouchers" :key="'promo-' + index">
                            <div class="voucher-card-inner promo-card">
                                <div class="voucher-ribbon promo-ribbon">
                                    <span>PROMO!</span>
                                </div>
                                <div class="voucher-header bg-gradient-promo">
                                    <div class="voucher-price">
                                        <span class="original-price" v-if="voucher.price_before_discount > voucher.price_after_discount">
                                            Rp {{ formatPrice(voucher.price_before_discount) }}
                                        </span>
                                        <span class="current-price">Rp {{ formatPrice(voucher.price_after_discount) }}</span>
                                        <span class="price-period">/{{ voucher.active_period }} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span>
                                    </div>
                                </div>
                                <div class="voucher-body">
                                    <h6 class="voucher-name">{{ voucher.name }}</h6>
                                    <div class="voucher-badges" v-if="voucher.member_categories">
                                        <span class="member-badge" v-for="(member, idx) in voucher.member_categories" :key="idx">
                                            {{ member }}
                                        </span>
                                    </div>
                                    <div class="voucher-badges" v-else>
                                        <span class="member-badge all-access">Semua Member</span>
                                    </div>
                                    <div class="voucher-description" v-html="voucher.description"></div>
                                </div>
                                <div class="voucher-footer">
                                    <Link :href="`/user/vouchers/${voucher.id}/buy`" class="btn-select-voucher">
                                        <i class="bx bx-cart-add"></i>
                                        Pilih Paket
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SKD Section -->
                <div class="voucher-category-section" v-if="skdVouchers.length && activeCategory !== 'promo' && activeCategory !== 'other'">
                    <div class="category-section-header">
                        <div class="category-badge skd-badge">
                            <i class="bx bx-book"></i>
                            PAKET SKD
                        </div>
                        <span class="category-subtitle">Seleksi Kompetensi Dasar</span>
                    </div>
                    <div class="voucher-grid">
                        <div class="voucher-card-modern" v-for="(voucher, index) in displayedSkdVouchers" :key="'skd-' + index">
                            <div class="voucher-card-inner">
                                <div class="voucher-ribbon" v-if="voucher.price_before_discount > voucher.price_after_discount">
                                    <span>{{ Math.round((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100) }}% OFF</span>
                                </div>
                                <div class="voucher-header bg-gradient-skd">
                                    <div class="voucher-price">
                                        <span class="original-price" v-if="voucher.price_before_discount > voucher.price_after_discount">
                                            Rp {{ formatPrice(voucher.price_before_discount) }}
                                        </span>
                                        <span class="current-price">Rp {{ formatPrice(voucher.price_after_discount) }}</span>
                                        <span class="price-period">/{{ voucher.active_period }} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span>
                                    </div>
                                </div>
                                <div class="voucher-body">
                                    <h6 class="voucher-name">{{ voucher.name }}</h6>
                                    <div class="voucher-badges" v-if="voucher.member_categories">
                                        <span class="member-badge" v-for="(member, idx) in voucher.member_categories" :key="idx">
                                            {{ member }}
                                        </span>
                                    </div>
                                    <div class="voucher-badges" v-else>
                                        <span class="member-badge all-access">Semua Member</span>
                                    </div>
                                    <div class="voucher-description" v-html="voucher.description"></div>
                                    <div class="voucher-quota" v-if="voucher.user_limit && voucher.user_limit > voucher.voucher_selected_transacation_count">
                                        <div class="quota-bar">
                                            <div class="quota-fill" :style="{ width: ((voucher.user_limit - voucher.voucher_selected_transacation_count) / voucher.user_limit * 100) + '%' }"></div>
                                        </div>
                                        <span class="quota-text">Tersisa {{ voucher.user_limit - voucher.voucher_selected_transacation_count }} dari {{ voucher.user_limit }} kuota</span>
                                    </div>
                                </div>
                                <div class="voucher-footer">
                                    <Link :href="`/user/vouchers/${voucher.id}/buy`" class="btn-select-voucher">
                                        <i class="bx bx-cart-add"></i>
                                        Pilih Paket
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Packages Section -->
                <div class="voucher-category-section" v-if="otherVouchers.length && activeCategory !== 'promo' && activeCategory !== 'skd'">
                    <div class="category-section-header">
                        <div class="category-badge other-badge">
                            <i class="bx bx-package"></i>
                            Paket Seleksi Lanjutan
                        </div>
                        <span class="category-subtitle">Seleksi Lanjutan Kedinasan</span>
                    </div>
                    <div class="voucher-grid">
                        <div class="voucher-card-modern" v-for="(voucher, index) in displayedOtherVouchers" :key="'other-' + index">
                            <div class="voucher-card-inner">
                                <div class="voucher-ribbon" v-if="voucher.price_before_discount > voucher.price_after_discount">
                                    <span>{{ Math.round((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100) }}% OFF</span>
                                </div>
                                <div class="voucher-header" :class="getVoucherHeaderClass(voucher)">
                                    <div class="voucher-price">
                                        <span class="original-price" v-if="voucher.price_before_discount > voucher.price_after_discount">
                                            Rp {{ formatPrice(voucher.price_before_discount) }}
                                        </span>
                                        <span class="current-price">Rp {{ formatPrice(voucher.price_after_discount) }}</span>
                                        <span class="price-period">/{{ voucher.active_period }} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span>
                                    </div>
                                </div>
                                <div class="voucher-body">
                                    <h6 class="voucher-name">{{ voucher.name }}</h6>
                                    <div class="voucher-category-tag" v-if="voucher.category">
                                        {{ voucher.category.name }}
                                    </div>
                                    <div class="voucher-badges" v-if="voucher.member_categories">
                                        <span class="member-badge" v-for="(member, idx) in voucher.member_categories" :key="idx">
                                            {{ member }}
                                        </span>
                                    </div>
                                    <div class="voucher-badges" v-else>
                                        <span class="member-badge all-access">Semua Member</span>
                                    </div>
                                    <div class="voucher-description" v-html="voucher.description"></div>
                                    <div class="voucher-quota" v-if="voucher.user_limit && voucher.user_limit > voucher.voucher_selected_transacation_count">
                                        <div class="quota-bar">
                                            <div class="quota-fill" :style="{ width: ((voucher.user_limit - voucher.voucher_selected_transacation_count) / voucher.user_limit * 100) + '%' }"></div>
                                        </div>
                                        <span class="quota-text">Tersisa {{ voucher.user_limit - voucher.voucher_selected_transacation_count }} dari {{ voucher.user_limit }} kuota</span>
                                    </div>
                                </div>
                                <div class="voucher-footer">
                                    <Link :href="`/user/vouchers/${voucher.id}/buy`" class="btn-select-voucher">
                                        <i class="bx bx-cart-add"></i>
                                        Pilih Paket
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="empty-voucher-state" v-if="filteredVouchers.length === 0">
                    <i class="bx bx-search-alt"></i>
                    <h6>Tidak Ada Paket Ditemukan</h6>
                    <p>Coba ubah filter harga atau kategori untuk menemukan paket yang sesuai</p>
                    <button class="btn-reset-filter" @click="resetFilters">
                        <i class="bx bx-refresh"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
import LayoutUser from "../../../Layouts/Layout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, computed } from 'vue';

export default {
    layout: LayoutUser,
    components: {
        Head,
        Link,
    },
    props: {
        totalTransactionPending: Object,
        totalTransactionPaid: Object,
        totalTransactionDone: Object,
        totalTransactionFailed: Object,
        transactions: Array,
        gradeSummaries: Object,
        announcementSummaries: Object,
        totalDataInCategories: Object,
        vouchers: Array,
    },
    setup(props) {
        const activeCategory = ref('all');
        
        // Calculate max price from vouchers
        const maxPrice = computed(() => {
            if (!props.vouchers || props.vouchers.length === 0) return 1000000;
            return Math.max(...props.vouchers.map(v => v.price_after_discount), 1000000);
        });
        
        const priceRange = ref([0, maxPrice.value]);

        const updateMinPrice = (e) => {
            const value = parseInt(e.target.value);
            if (value <= priceRange.value[1]) {
                priceRange.value[0] = value;
            }
        };

        const updateMaxPrice = (e) => {
            const value = parseInt(e.target.value);
            if (value >= priceRange.value[0]) {
                priceRange.value[1] = value;
            }
        };

        const sliderTrackStyle = computed(() => {
            const min = (priceRange.value[0] / maxPrice.value) * 100;
            const max = (priceRange.value[1] / maxPrice.value) * 100;
            return {
                left: min + '%',
                width: (max - min) + '%'
            };
        });

        // Categorize vouchers
        const promoVouchers = computed(() => {
            return (props.vouchers || []).filter(v => 
                v.price_after_discount >= 0 && v.price_after_discount <= 5000
            );
        });

        const skdVouchers = computed(() => {
            return (props.vouchers || []).filter(v => {
                const name = (v.name || '').toLowerCase();
                const categoryName = (v.category?.name || '').toLowerCase();
                return (name.includes('skd') || categoryName.includes('skd') || 
                        name.includes('cpns') || categoryName.includes('cpns')) &&
                       v.price_after_discount > 5000;
            });
        });

        const otherVouchers = computed(() => {
            return (props.vouchers || []).filter(v => {
                const name = (v.name || '').toLowerCase();
                const categoryName = (v.category?.name || '').toLowerCase();
                const isSkd = name.includes('skd') || categoryName.includes('skd') || 
                              name.includes('cpns') || categoryName.includes('cpns');
                return !isSkd && v.price_after_discount > 5000;
            });
        });

        // Apply price filter
        const applyPriceFilter = (vouchers) => {
            return vouchers.filter(v => 
                v.price_after_discount >= priceRange.value[0] && 
                v.price_after_discount <= priceRange.value[1]
            );
        };

        const displayedPromoVouchers = computed(() => applyPriceFilter(promoVouchers.value));
        const displayedSkdVouchers = computed(() => applyPriceFilter(skdVouchers.value));
        const displayedOtherVouchers = computed(() => applyPriceFilter(otherVouchers.value));

        const filteredVouchers = computed(() => {
            let result = [];
            if (activeCategory.value === 'all') {
                result = [...displayedPromoVouchers.value, ...displayedSkdVouchers.value, ...displayedOtherVouchers.value];
            } else if (activeCategory.value === 'promo') {
                result = displayedPromoVouchers.value;
            } else if (activeCategory.value === 'skd') {
                result = displayedSkdVouchers.value;
            } else if (activeCategory.value === 'other') {
                result = displayedOtherVouchers.value;
            }
            return result;
        });

        const resetFilters = () => {
            activeCategory.value = 'all';
            priceRange.value = [0, maxPrice.value];
        };

        return {
            activeCategory,
            priceRange,
            maxPrice,
            promoVouchers,
            skdVouchers,
            otherVouchers,
            displayedPromoVouchers,
            displayedSkdVouchers,
            displayedOtherVouchers,
            filteredVouchers,
            updateMinPrice,
            updateMaxPrice,
            sliderTrackStyle,
            resetFilters
        };
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed().replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        getCategoryClass(index) {
            const classes = ['gradient-primary', 'gradient-secondary', 'gradient-primary', 'gradient-secondary'];
            return classes[index % classes.length];
        },
        getVoucherHeaderClass(voucher) {
            if (voucher.category?.name === 'POLRI') return 'bg-gradient-polri';
            if (voucher.category?.name === 'TNI') return 'bg-gradient-tni';
            if (voucher.category?.name === 'Kedinasan') return 'bg-gradient-kedinasan';
            return 'bg-gradient-primary';
        },
        getTransactionStatusClass(status) {
            const classes = {
                'pending': 'status-pending',
                'paid': 'status-paid',
                'done': 'status-done',
                'failed': 'status-failed',
                'expired': 'status-expired'
            };
            return classes[status] || 'status-pending';
        },
        getTransactionIcon(status) {
            const icons = {
                'pending': 'bx-time-five',
                'paid': 'bx-check',
                'done': 'bx-check-double',
                'failed': 'bx-x',
                'expired': 'bx-x-circle'
            };
            return icons[status] || 'bx-time-five';
        },
        getTransactionStatusLabel(status) {
            const labels = {
                'pending': 'Menunggu',
                'paid': 'Dibayar',
                'done': 'Selesai',
                'failed': 'Gagal',
                'expired': 'Kadaluarsa'
            };
            return labels[status] || status;
        }
    },
};
</script>

<style scoped>
/* Color Variables */
:root {
    --primary-blue: #1477F5;
    --primary-yellow: #F8C62C;
}

/* Welcome Section */
.welcome-section {
    margin-bottom: 2rem;
}

.welcome-card {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(20, 119, 245, 0.3);
}

.welcome-content {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.welcome-title {
    color: #fff;
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.user-name {
    color: #F8C62C;
}

.welcome-subtitle {
    color: rgba(255, 255, 255, 0.85);
    font-size: 1rem;
    margin: 0;
    max-width: 500px;
}

.stat-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #fff;
    background: linear-gradient(135deg, #F8C62C, #e5b526);
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
}

.stat-value {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 700;
}

.welcome-decoration {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 50%;
    overflow: hidden;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    background: #F8C62C;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 200px;
    height: 200px;
    top: -50px;
    right: -50px;
}

.shape-2 {
    width: 150px;
    height: 150px;
    bottom: -30px;
    right: 100px;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    top: 50%;
    right: 30%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

/* Section Headers */
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.section-title i {
    font-size: 1.25rem;
    color: #1477F5;
}

/* Categories Grid */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.category-card-modern a {
    text-decoration: none;
}

.category-card-inner {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    border-radius: 16px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.category-card-inner:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.category-card-inner.gradient-primary {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
}

.category-card-inner.gradient-secondary {
    background: linear-gradient(135deg, #F8C62C 0%, #e5b526 100%);
}

.category-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: #fff;
    margin-right: 1rem;
}

.category-info {
    flex: 1;
}

.category-name {
    color: #fff;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.stat-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    color: #fff;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.category-arrow {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

.category-card-inner:hover .category-arrow {
    transform: translateX(5px);
}

/* Info Cards */
.info-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    height: 100%;
}

.info-card-header {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    border-bottom: 1px solid #f3f4f6;
    gap: 1rem;
}

.header-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: #fff;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #10b981, #059669);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
}

.header-title {
    flex: 1;
    margin: 0;
    font-weight: 600;
    font-size: 1rem;
    color: #1f2937;
}

.view-all-link {
    color: #1477F5;
    text-decoration: none;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: color 0.2s;
}

.view-all-link:hover {
    color: #0d5cbf;
}

.info-card-body {
    padding: 1.25rem;
    max-height: 300px;
    overflow-y: auto;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #9ca3af;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

/* Announcement List */
.announcement-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.announcement-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: #f9fafb;
    border-radius: 10px;
    transition: background 0.2s;
}

.announcement-item:hover {
    background: #f3f4f6;
}

.announcement-dot {
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    border-radius: 50%;
    flex-shrink: 0;
}

.announcement-link {
    color: #374151;
    text-decoration: none;
    font-size: 0.9rem;
    line-height: 1.4;
}

.announcement-link:hover {
    color: #1477F5;
}

/* Transaction List */
.transaction-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.transaction-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: #f9fafb;
    border-radius: 10px;
}

.transaction-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.transaction-icon.status-pending { background: #fef3c7; color: #d97706; }
.transaction-icon.status-paid { background: #d1fae5; color: #059669; }
.transaction-icon.status-done { background: #dbeafe; color: #1477F5; }
.transaction-icon.status-failed { background: #fee2e2; color: #dc2626; }
.transaction-icon.status-expired { background: #f3f4f6; color: #6b7280; }

.transaction-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.transaction-desc {
    font-size: 0.9rem;
    color: #374151;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px;
}

.transaction-amount {
    font-size: 0.8rem;
    color: #6b7280;
}

.transaction-status {
    font-size: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
}

.transaction-status.status-pending { background: #fef3c7; color: #d97706; }
.transaction-status.status-paid { background: #d1fae5; color: #059669; }
.transaction-status.status-done { background: #dbeafe; color: #1477F5; }
.transaction-status.status-failed { background: #fee2e2; color: #dc2626; }
.transaction-status.status-expired { background: #f3f4f6; color: #6b7280; }

/* Voucher Filter Section */
.voucher-header-section {
    margin-bottom: 1.5rem;
}

.voucher-filter-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-top: 1rem;
}

.filter-row {
    margin-bottom: 1.5rem;
}

.category-tabs {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.tab-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: #fff;
    color: #6b7280;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    border-color: #1477F5;
    color: #1477F5;
}

.tab-btn.active {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    border-color: #1477F5;
    color: #fff;
}

.tab-btn i {
    font-size: 1.1rem;
}

/* Price Filter */
.price-filter {
    margin-bottom: 1rem;
}

.price-filter-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-weight: 500;
    color: #374151;
}

.price-range-display {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
}

.price-slider-container {
    position: relative;
    height: 30px;
    display: flex;
    align-items: center;
}

.price-slider {
    position: absolute;
    width: 100%;
    height: 8px;
    background: transparent;
    -webkit-appearance: none;
    pointer-events: none;
    z-index: 2;
}

.price-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 24px;
    height: 24px;
    background: #1477F5;
    border: 3px solid #fff;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: auto;
    box-shadow: 0 2px 8px rgba(20, 119, 245, 0.4);
}

.price-slider::-moz-range-thumb {
    width: 24px;
    height: 24px;
    background: #1477F5;
    border: 3px solid #fff;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: auto;
    box-shadow: 0 2px 8px rgba(20, 119, 245, 0.4);
}

.slider-track {
    position: absolute;
    height: 8px;
    background: linear-gradient(90deg, #1477F5, #F8C62C);
    border-radius: 4px;
    z-index: 1;
}

.price-slider-container::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
}

.price-labels {
    display: flex;
    justify-content: space-between;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #9ca3af;
}

.filter-result-count {
    display: flex;
    justify-content: flex-end;
}

.result-badge {
    background: #F8C62C;
    color: #1f2937;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Category Section Headers */
.voucher-category-section {
    margin-bottom: 2rem;
}

.category-section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #f3f4f6;
}

.category-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.9rem;
    color: #fff;
}

.promo-badge {
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    color: #1f2937;
}

.skd-badge {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
}

.other-badge {
    background: linear-gradient(135deg, #6b7280, #4b5563);
}

.category-subtitle {
    color: #6b7280;
    font-size: 0.9rem;
}

/* Voucher Grid */
.voucher-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.voucher-card-modern {
    height: 100%;
}

.voucher-card-inner {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.voucher-card-inner:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.voucher-card-inner.promo-card {
    border: 2px solid #F8C62C;
}

.voucher-ribbon {
    position: absolute;
    top: 20px;
    right: -35px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    padding: 0.25rem 2.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    transform: rotate(45deg);
    z-index: 10;
}

.promo-ribbon {
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    color: #1f2937;
}

.voucher-header {
    padding: 1.5rem;
    text-align: center;
    color: #fff;
}

.bg-gradient-promo {
    background: linear-gradient(135deg, #F8C62C 0%, #e5b526 100%);
    color: #1f2937 !important;
}

.bg-gradient-skd {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
}

.bg-gradient-polri {
    background: linear-gradient(135deg, #6b7280, #4b5563);
}

.bg-gradient-tni {
    background: linear-gradient(135deg, #059669, #047857);
}

.bg-gradient-kedinasan {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.voucher-price {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.original-price {
    text-decoration: line-through;
    opacity: 0.7;
    font-size: 0.9rem;
}

.current-price {
    font-size: 1.75rem;
    font-weight: 700;
}

.bg-gradient-promo .current-price {
    color: #1f2937;
}

.price-period {
    font-size: 0.9rem;
    opacity: 0.8;
}

.voucher-body {
    padding: 1.5rem;
    flex: 1;
}

.voucher-name {
    text-align: center;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
}

.voucher-category-tag {
    text-align: center;
    background: #f3f4f6;
    color: #6b7280;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    display: inline-block;
    margin-bottom: 0.75rem;
}

.voucher-badges {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.member-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.member-badge.all-access {
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
}

.voucher-description {
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.6;
    min-height: 80px;
    max-height: 120px;
    overflow-y: auto;
}

.voucher-quota {
    margin-top: 1rem;
}

.quota-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.quota-fill {
    height: 100%;
    background: linear-gradient(90deg, #1477F5, #F8C62C);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.quota-text {
    font-size: 0.75rem;
    color: #6b7280;
}

.voucher-footer {
    padding: 1.5rem;
    border-top: 1px solid #f3f4f6;
}

.btn-select-voucher {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.875rem;
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-select-voucher:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(20, 119, 245, 0.4);
    color: #fff;
}

/* Empty Voucher State */
.empty-voucher-state {
    text-align: center;
    padding: 3rem;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.empty-voucher-state i {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 1rem;
}

.empty-voucher-state h6 {
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-voucher-state p {
    color: #9ca3af;
    margin-bottom: 1.5rem;
}

.btn-reset-filter {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #F8C62C, #e5b526);
    color: #1f2937;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-reset-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(248, 198, 44, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-card {
        padding: 1.5rem;
    }
    
    .welcome-title {
        font-size: 1.25rem;
    }
    
    .welcome-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .categories-grid {
        grid-template-columns: 1fr;
    }
    
    .voucher-grid {
        grid-template-columns: 1fr;
    }
    
    .category-tabs {
        justify-content: center;
    }
    
    .tab-btn {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
}
</style>
