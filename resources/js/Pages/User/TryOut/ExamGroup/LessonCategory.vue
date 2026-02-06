<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Kategori Mata Pelajaran</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Modern Header -->
            <div class="lesson-header mb-4">
                <div class="header-card">
                    <div class="header-content">
                        <div class="header-text">
                            <Link href="/user/dashboard" class="back-link">
                                <i class="bx bx-arrow-back"></i>
                            </Link>
                            <div>
                                <h4 class="header-title">Kategori Mata Pelajaran</h4>
                                <p class="header-subtitle">Pilih kategori untuk melihat try out yang tersedia</p>
                            </div>
                        </div>
                    </div>
                    <div class="header-decoration">
                        <div class="floating-circle c1"></div>
                        <div class="floating-circle c2"></div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="!lessonCategories.length" class="empty-state-card">
                <div class="empty-icon">
                    <i class="bx bx-folder-open"></i>
                </div>
                <h5>Kategori Mata Pelajaran Belum Tersedia</h5>
                <p>Silakan hubungi admin untuk informasi lebih lanjut</p>
            </div>

            <!-- Category Grid -->
            <div class="lesson-category-grid">
                <div class="lesson-category-card" v-for="(lessonCategory, index) in lessonCategories" :key="index">
                    <Link :href="`/user/exam-groups/${lessonCategory.category_id}/lesson-categories/${lessonCategory.id}/exams`">
                        <div class="category-card-wrapper" :class="getGradientClass(index)">
                            <div class="category-thumbnail">
                                <img v-bind:src="'/storage/upload_files/lesson_categories/' + lessonCategory.thumbnail" :alt="lessonCategory.name"/>
                                <div class="thumbnail-overlay"></div>
                            </div>
                            <div class="category-content">
                                <div class="category-badge">
                                    <i class="bx bx-book-reader"></i>
                                    Try Out
                                </div>
                                <h5 class="category-title">{{ lessonCategory.name }}</h5>
                                <div class="category-footer">
                                    <span class="see-more">
                                        Lihat Try Out <i class="bx bx-right-arrow-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
import LayoutUser from '../../../../Layouts/Layout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: LayoutUser,
    components: {
        Link,
        Head,
    },
    props: {
        lessonCategories: Object
    },
    methods: {
        getGradientClass(index) {
            const classes = ['gradient-blue', 'gradient-yellow', 'gradient-blue', 'gradient-yellow'];
            return classes[index % classes.length];
        }
    }
}
</script>

<style scoped>
/* Header Styles */
.lesson-header {
    margin-bottom: 2rem;
}

.header-card {
    background: linear-gradient(135deg, #1477F5 0%, #0d5cbf 100%);
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(20, 119, 245, 0.3);
}

.header-content {
    position: relative;
    z-index: 2;
}

.header-text {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.back-link {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-5px);
}

.header-title {
    color: #fff;
    font-weight: 700;
    margin: 0;
}

.header-subtitle {
    color: rgba(255, 255, 255, 0.8);
    margin: 0.25rem 0 0;
    font-size: 0.9rem;
}

.header-decoration {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 200px;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(248, 198, 44, 0.2);
}

.c1 {
    width: 150px;
    height: 150px;
    top: -50px;
    right: -50px;
}

.c2 {
    width: 100px;
    height: 100px;
    bottom: -30px;
    right: 50px;
}

/* Empty State */
.empty-state-card {
    background: #fff;
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    color: #9ca3af;
}

.empty-state-card h5 {
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-state-card p {
    color: #9ca3af;
    margin: 0;
}

/* Category Grid */
.lesson-category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.lesson-category-card a {
    text-decoration: none;
}

.category-card-wrapper {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.category-card-wrapper:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.category-thumbnail {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.category-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.category-card-wrapper:hover .category-thumbnail img {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
}

.category-content {
    padding: 1.5rem;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.gradient-blue .category-badge {
    background: linear-gradient(135deg, rgba(20, 119, 245, 0.1), rgba(13, 92, 191, 0.1));
    color: #1477F5;
}

.gradient-yellow .category-badge {
    background: linear-gradient(135deg, rgba(248, 198, 44, 0.2), rgba(229, 181, 38, 0.2));
    color: #b8860b;
}

.category-title {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.category-footer {
    display: flex;
    justify-content: flex-end;
}

.see-more {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.gradient-blue .see-more {
    color: #1477F5;
}

.gradient-yellow .see-more {
    color: #b8860b;
}

.category-card-wrapper:hover .see-more {
    gap: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .header-card {
        padding: 1.5rem;
    }
    
    .lesson-category-grid {
        grid-template-columns: 1fr;
    }
}
</style>
