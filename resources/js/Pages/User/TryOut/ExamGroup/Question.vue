<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? "SpeedU CBT" }} - Pengerjaan Try Out</title>
    </Head>

    <div class="exam-wrapper">
        <!-- Top Bar with Timer and User Info -->
        <div class="exam-topbar">
            <div class="topbar-container">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ $page.props.auth.user.name }}</span>
                        <span class="exam-name">{{ exam.title }}</span>
                    </div>
                </div>

                <div class="exam-timer">
                    <div class="timer-label">Sisa Waktu</div>
                    <VueCountdown
                        :transform="transform"
                        :time="duration"
                        @progress="handleChangeDuration"
                        @end="handleTimeUp"
                        v-slot="{ hours, minutes, seconds }"
                    >
                        <div class="timer-display" :class="{ 'warning': minutes < 5 && hours == 0 }">
                            <span class="time-block">{{ hours }}</span>
                            <span class="separator">:</span>
                            <span class="time-block">{{ minutes }}</span>
                            <span class="separator">:</span>
                            <span class="time-block">{{ seconds }}</span>
                        </div>
                    </VueCountdown>
                </div>
            </div>
        </div>

        <div class="container-fluid exam-content-area">
            <div class="row h-100">
                <!-- Main Question Area -->
                <div class="col-lg-8 h-100 d-flex flex-column">
                    <div class="question-card">
                        <!-- Question Header -->
                        <div class="question-header">
                            <div class="question-number">
                                <span class="label">Soal No.</span>
                                <span class="number">{{ questionLists[indexPage]["navigation_order"] }}</span>
                            </div>
                            <div class="question-meta">
                                <span class="badge bg-light text-primary">
                                    <i class="bx bx-bookmarks"></i> Mapel: {{ exam.title }}
                                </span>
                            </div>
                        </div>

                        <!-- Question Body -->
                        <div class="question-body">
                            <div v-if="questionLists[indexPage]">
                                <div class="question-text mb-4">
                                    <div v-html="processedQuestion" class="prevent-select"></div>
                                </div>

                                <!-- Multiple Choice Options (Type 1) -->
                                <div v-if="exam.type_option == 1" class="options-list">
                                    <div 
                                        v-for="(answer, index) in questionLists[indexPage]['answer_order'].split(',')" 
                                        :key="index"
                                        class="option-item"
                                        :class="{ 'selected': answer == getMyAnswer(questionLists[indexPage]['question_id']) }"
                                        @click="submitAnswer(questionLists[indexPage]['question_id'], answer)"
                                    >
                                        <div class="option-marker">{{ options[index] }}</div>
                                        <div class="option-content">
                                            <div v-if="exam.show_answer == 1" v-html="processedOptions[answer]" class="prevent-select"></div>
                                            <div v-else>Pilihan {{ options[index] }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Multiple Choice Options (Type 2) -->
                                <div v-if="exam.type_option == 2" class="options-list type-2">
                                     <div class="options-display mb-3">
                                        <table class="table table-borderless">
                                            <tr v-for="(answer, index) in questionLists[indexPage]['answer_order'].split(',')" :key="index">
                                                <td width="30" class="fw-bold">{{ options[index] }}.</td>
                                                <td><div v-html="processedOptions[answer]"></div></td>
                                            </tr>
                                        </table>
                                     </div>
                                     <div class="options-actions d-flex gap-2">
                                        <button 
                                            v-for="(answer, index) in questionLists[indexPage]['answer_order'].split(',')"
                                            :key="index"
                                            class="btn btn-option"
                                            :class="{ 'active': answer == getMyAnswer(questionLists[indexPage]['question_id']) }"
                                            @click="submitAnswer(questionLists[indexPage]['question_id'], answer)"
                                        >
                                            {{ options[index] }}
                                        </button>
                                     </div>
                                </div>
                            </div>
                            <div v-else class="empty-question">
                                <div class="alert alert-danger">
                                    <i class="bx bx-error"></i> Soal tidak ditemukan!
                                </div>
                            </div>
                        </div>

                        <!-- Question Footer (Navigation Buttons) -->
                        <div class="question-footer">
                            <div class="nav-buttons">
                                <button v-if="indexPage > 0" @click="prevPage()" class="btn btn-nav btn-outline-secondary">
                                    <i class="bx bx-chevron-left"></i> Sebelumnya
                                </button>
                                <button v-if="indexPage < Object.keys(questionLists).length - 1" @click="nextPage()" class="btn btn-nav btn-primary">
                                    Selanjutnya <i class="bx bx-chevron-right"></i>
                                </button>
                            </div>

                            <!-- Finish Button Logic -->
                            <div class="finish-buttons">
                                <template v-if="exam.button_type_finish == 1">
                                    <button 
                                        v-if="section == lastSection" 
                                        @click="showModalEndExam = true" 
                                        class="btn btn-finish btn-danger"
                                    >
                                        <i class="bx bx-check-circle"></i> Akhiri Try Out
                                    </button>
                                    <button 
                                        v-else 
                                        @click="endExam" 
                                        class="btn btn-finish btn-warning"
                                    >
                                        Lanjut Bagian Berikutnya
                                    </button>
                                </template>
                                <template v-else>
                                    <button 
                                        v-if="section == lastSection && indexPage >= Object.keys(questionLists).length - 1" 
                                        @click="showModalEndExam = true" 
                                        class="btn btn-finish btn-danger"
                                    >
                                        <i class="bx bx-check-circle"></i> Akhiri Try Out
                                    </button>
                                    <button 
                                        v-if="section < lastSection && indexPage >= Object.keys(questionLists).length - 1" 
                                        @click="endExam" 
                                        class="btn btn-finish btn-warning"
                                    >
                                        Lanjut Bagian Berikutnya
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Sidebar -->
                <div class="col-lg-4 h-100">
                    <div class="nav-sidebar">
                        <div class="nav-header">
                            <h5>Navigasi Soal</h5>
                            <div class="progress-info">
                                <div class="progress-stats">
                                    <div class="stat-item answered">
                                        <span class="count">{{ answeredCount }}</span>
                                        <span class="label">Terjawab</span>
                                    </div>
                                    <div class="stat-item unanswered">
                                        <span class="count">{{ totalQuestions - answeredCount }}</span>
                                        <span class="label">Belum</span>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar bg-success" :style="{ width: (answeredCount / totalQuestions * 100) + '%' }"></div>
                                </div>
                            </div>
                        </div>

                        <div class="nav-grid-wrapper">
                            <div class="nav-grid">
                                <div 
                                    v-for="(question, index) in questionLists" 
                                    :key="index" 
                                    class="nav-item-wrapper"
                                >
                                    <button 
                                        class="nav-item" 
                                        :class="{
                                            'active': index == indexPage,
                                            'answered': getMyAnswer(question.question_id) != 0 && index != indexPage,
                                            'unanswered': getMyAnswer(question.question_id) == 0 && index != indexPage
                                        }"
                                        @click="clickQuestion(index)"
                                    >
                                        {{ question.navigation_order }}
                                        <span v-if="getMyAnswer(question.question_id) != 0" class="check-icon"><i class="bx bx-check"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="nav-legend">
                            <div class="legend-item"><span class="dot active"></span> Sekarang</div>
                            <div class="legend-item"><span class="dot answered"></span> Terjawab</div>
                            <div class="legend-item"><span class="dot unanswered"></span> Belum</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- End Exam Modal -->
    <div v-if="showModalEndExam" class="modal-backdrop-custom">
        <div class="modal-custom">
            <div class="modal-icon warning">
                <i class="bx bx-error-circle"></i>
            </div>
            <h4>Akhiri Try Out?</h4>
            <p>Setelah mengakhiri Try Out, Anda tidak dapat kembali ke sesi ini. Pastikan semua jawaban sudah terisi.</p>
            <div class="modal-actions">
                <button @click="showModalEndExam = false" class="btn btn-light">Batal</button>
                <button @click="endExam" class="btn btn-danger">Ya, Akhiri</button>
            </div>
        </div>
    </div>

    <!-- Time Up Modal -->
    <div v-if="showModalEndTimeExam" class="modal-backdrop-custom">
        <div class="modal-custom">
            <div class="modal-icon timer">
                <i class="bx bx-time-five"></i>
            </div>
            <h4>Waktu Habis!</h4>
            <p v-if="section == lastSection">Waktu pengerjaan sudah habis. Jawaban Anda akan disimpan otomatis.</p>
            <div v-else>Lanjut ke bagian selanjutnya dalam hitungan:</div>
            
            <div v-if="section != lastSection" class="countdown-large">
                <VueCountdown :time="5000" @end="endExam" v-slot="{ seconds }">
                    <span>{{ seconds }}</span>
                </VueCountdown>
            </div>
            
            <div class="modal-actions">
                <button @click="endExam" class="btn btn-primary w-100">Lanjutkan</button>
            </div>
        </div>
    </div>

</template>

<script>
// Logic preserved but cleaned up
import LayoutUser from "../../../../Layouts/LayoutUser.vue";
import MathJax, { initMathJax, renderByMathjax } from "mathjax-vue3";
import axios from "axios";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref, computed, onMounted, nextTick } from "vue";
import VueCountdown from "@chenfengyuan/vue-countdown";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import { wrapLatexInText } from "./wrapLatex.js";

export default {
    layout: LayoutUser,
    components: {
        Head,
        Link,
        VueCountdown,
        MathJax,
    },
    props: {
        id: String,
        page: Number,
        exam: Object,
        duration: Object,
        questionLists: Object,
        section: Number,
        lastSection: Number,
        grade: Object,
        indexPage: Object,
    },
    setup(props) {
        // --- State Management ---
        const indexPage = ref(props.indexPage);
        const storedIndexPage = localStorage.getItem("indexPage");
        if (storedIndexPage !== null) {
            indexPage.value = parseInt(storedIndexPage);
        }

        const options = ["A", "B", "C", "D", "E"];
        const myAnswers = ref([]);
        
        // --- Initialization ---
        const initializeExam = () => {
            if (props.exam.id != localStorage.getItem("examId")) {
                localStorage.setItem("examId", props.exam.id);
                localStorage.setItem("myAnswers", JSON.stringify([]));
                myAnswers.value = [];
            } else {
                const storedArray = localStorage.getItem("myAnswers");
                myAnswers.value = storedArray ? JSON.parse(storedArray) : [];
            }
        };
        initializeExam();

        const duration = ref(props.duration);
        const showModalEndExam = ref(false);
        const showModalEndTimeExam = ref(false);
        const answeredQuestionsCount = ref(0); // Counter for periodic sync

        // --- Computed ---
        const totalQuestions = computed(() => Object.keys(props.questionLists).length);
        const answeredCount = computed(() => {
            // Count unique answered questions for current section based on available questions
            let count = 0;
            const qIds = Object.values(props.questionLists).map(q => q.question_id);
            myAnswers.value.forEach(ans => {
                if (qIds.includes(ans.question_id) && ans.answer != 0) {
                    count++;
                }
            });
            return count;
        });

        // --- Question Processing (MathJax & Images) ---
        const processedQuestion = computed(() => {
            if (!props.questionLists[indexPage.value]) return "";
            let question = props.questionLists[indexPage.value].question;
            return processContent(question);
        });

        const processedOptions = computed(() => {
             if (!props.questionLists[indexPage.value]) return {};
             let opts = {};
             // Options 1-5
             ['option_1', 'option_2', 'option_3', 'option_4', 'option_5'].forEach((key, idx) => {
                 if (props.questionLists[indexPage.value][key]) {
                     opts[options[idx]] = processContent(props.questionLists[indexPage.value][key]);
                 }
             });
             return opts;
        });

        const processContent = (content) => {
            if (!content) return "";
            // Use wrapLatexInText from helper
            return wrapLatexInText(content);
        };
        
        // --- Methods ---
        const loadMath = () => {
            nextTick(() => {
                if (window.MathJax) {
                    // Try/catch for safety
                    try {
                         window.MathJax.typesetPromise && window.MathJax.typesetPromise();
                    } catch(e) {}
                }
            });
        };

        const handleChangeDuration = () => {
            duration.value = duration.value - 1000;
        };

        const handleTimeUp = () => {
             showModalEndTimeExam.value = true;
        };

        const prevPage = () => {
            if (indexPage.value > 0) {
                indexPage.value--;
                saveState();
                loadMath();
            }
        };

        const nextPage = () => {
            if (indexPage.value < totalQuestions.value - 1) {
                indexPage.value++;
                saveState();
                loadMath();
            }
        };

        const clickQuestion = (index) => {
            indexPage.value = index;
            saveState();
            loadMath();
        };

        const getMyAnswer = (question_id) => {
            const item = myAnswers.value.find((item) => item.question_id === question_id);
            return item ? item.answer : 0;
        };

        const submitAnswer = (question_id, answer) => {
            const value = { question_id: question_id, answer: answer };
            const index = myAnswers.value.findIndex((item) => item.question_id === value.question_id);

            if (index !== -1) {
                myAnswers.value[index].answer = value.answer;
            } else {
                myAnswers.value.push(value);
            }

            saveState();
            
            // Auto next page if not last
            answeredQuestionsCount.value++;
            if (answeredQuestionsCount.value % 20 === 0) {
                 checkConnection(); // Info: periodic check
            }

            if (indexPage.value < totalQuestions.value - 1) {
                 setTimeout(() => nextPage(), 300); // Small delay for visual feedback
            }
        };

        const saveState = () => {
            localStorage.setItem("indexPage", indexPage.value);
            localStorage.setItem("myAnswers", JSON.stringify(myAnswers.value));
        };

        const checkConnection = () => {
             axios.get("/check-connection").catch(() => {
                 Swal.fire({
                     title: "Koneksi Terputus",
                     text: "Gagal menyimpan jawaban. Periksa koneksi internet Anda.",
                     icon: "error"
                 });
             });
        };

        const endExam = (block = "") => {
            checkConnection();
            
            // Prepare data
            const data = {
                exam_id: props.exam.id,
                grade_id: props.grade.id,
                myAnswers: myAnswers.value,
            };

            const finishUrl = `/user/exam-groups/${props.exam.id}/exam-end`;

            Inertia.post(finishUrl, data, {
                onSuccess: () => {
                    if (block === "block") {
                        Swal.fire("Ujian Diblokir", "Anda melewati batas toleransi.", "warning");
                    } else {
                        Swal.fire({
                             title: "Selesai!",
                             text: "Jawaban berhasil disimpan.",
                             icon: "success",
                             timer: 2000,
                             showConfirmButton: false
                        });
                    }
                },
                onError: (errors) => {
                     Swal.fire("Error", "Gagal mengakhiri ujian. Silakan coba lagi.", "error");
                }
            });
        };

        // --- Lifecycle ---
        onMounted(() => {
             // MathJax Init
             let script = document.createElement("script");
             script.src = "https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML";
             document.head.appendChild(script);
             
             // Initial MathJax render
             setTimeout(loadMath, 1000);
        });

        return {
            indexPage,
            options,
            myAnswers,
            duration,
            showModalEndExam,
            showModalEndTimeExam,
            totalQuestions,
            answeredCount,
            processedQuestion,
            processedOptions,
            handleChangeDuration,
            handleTimeUp,
            prevPage,
            nextPage,
            clickQuestion,
            getMyAnswer,
            submitAnswer,
            endExam
        };
    }
}
</script>

<style scoped>
/* Main Layout */
.exam-wrapper {
    background-color: #f0f2f5;
    height: 100vh; /* Fixed height for viewport */
    display: flex;
    flex-direction: column;
    overflow: hidden; /* Prevent body scroll */
}

/* Top Bar */
.exam-topbar {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 0.75rem 2rem;
    flex-shrink: 0; /* Don't shrink */
    z-index: 100;
}

.topbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #1477F5, #0d5cbf);
    color: #fff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
}

.exam-name {
    font-size: 0.8rem;
    color: #6b7280;
}

.exam-timer {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.timer-label {
    font-size: 0.7rem;
    color: #9ca3af;
    margin-bottom: 0.15rem;
}

.timer-display {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-family: 'Monaco', 'Consolas', monospace;
    font-weight: 700;
    font-size: 1.1rem;
    color: #1f2937;
    background: #f3f4f6;
    padding: 0.2rem 0.6rem;
    border-radius: 6px;
}

.timer-display.warning {
    color: #dc2626;
    background: #fee2e2;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.time-block {
    min-width: 1.8ch;
    text-align: center;
}

/* Content Area */
.exam-content-area {
    flex: 1;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
    padding: 1rem; /* Reduced padding */
    overflow: hidden; /* Ensure internal scrolling works */
}

/* Question Card */
.question-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.question-header {
    background: #fff;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
}

.question-number {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.question-number .label {
    color: #6b7280;
    font-weight: 500;
    font-size: 0.9rem;
}

.question-number .number {
    background: #1477F5;
    color: #fff;
    padding: 0.2rem 0.6rem;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.9rem;
}

.question-body {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto; /* Internal scrolling */
}

.question-text {
    font-size: 1.05rem;
    line-height: 1.6;
    color: #374151;
}

/* Options */
.options-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.option-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 0.85rem;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.option-item:hover {
    border-color: #1477F5;
    background: #f8fafc;
}

.option-item.selected {
    border-color: #1477F5;
    background: #eff6ff;
    box-shadow: 0 0 0 1px #1477F5 inset;
}

.option-marker {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    flex-shrink: 0;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.option-item.selected .option-marker {
    background: #1477F5;
    color: #fff;
}

.option-content {
    flex: 1;
    font-size: 0.95rem;
}

/* Footer & Nav Buttons */
.question-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    flex-shrink: 0;
}

.nav-buttons, .finish-buttons {
    display: flex;
    gap: 0.75rem;
}

.btn-nav, .btn-finish {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.6rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
}

/* Navigation Sidebar */
.nav-sidebar {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.nav-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #f3f4f6;
    flex-shrink: 0;
}

.nav-header h5 {
    margin-bottom: 0.75rem;
    font-weight: 600;
    color: #1f2937;
    font-size: 1.1rem;
}

.progress-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.4rem;
}

.stat-item {
    display: flex;
    align-items: baseline;
    gap: 0.25rem;
}

.stat-item .count {
    font-size: 1.1rem;
    font-weight: 700;
}

.stat-item.answered .count { color: #10b981; }
.stat-item.unanswered .count { color: #ef4444; }

.stat-item .label {
    font-size: 0.7rem;
    color: #6b7280;
}

.nav-grid-wrapper {
    flex: 1;
    overflow-y: auto;
    padding: 1.25rem;
}

.nav-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.6rem;
}

.nav-item-wrapper {
    aspect-ratio: 1;
}

.nav-item {
    width: 100%;
    height: 100%;
    border-radius: 8px;
    border: none;
    background: #f3f4f6;
    color: #4b5563;
    font-weight: 600;
    font-size: 0.85rem;
    position: relative;
    cursor: pointer;
    transition: all 0.2s;
}

.nav-item:hover {
    background: #e5e7eb;
}

.nav-item.active {
    background: #1477F5;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 3px 10px rgba(20, 119, 245, 0.3);
    z-index: 2;
}

.nav-item.answered {
    background: #10b981;
    color: #fff;
}

.nav-item.unanswered {
    background: #f3f4f6;
    color: #4b5563;
}

.check-icon {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #fff;
    color: #10b981;
    border-radius: 50%;
    width: 14px;
    height: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.nav-legend {
    padding: 0.75rem;
    border-top: 1px solid #f3f4f6;
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-shrink: 0;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.75rem;
    color: #6b7280;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.dot.active { background: #1477F5; }
.dot.answered { background: #10b981; }
.dot.unanswered { background: #e5e7eb; }

/* Custom Modals */
.modal-backdrop-custom {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    backdrop-filter: blur(5px);
}

.modal-custom {
    background: #fff;
    padding: 2rem;
    border-radius: 20px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.modal-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1.5rem;
}

.modal-icon.warning { background: #fee2e2; color: #dc2626; }
.modal-icon.timer { background: #fef3c7; color: #d97706; }

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1.5rem;
}

.countdown-large {
    font-size: 4rem;
    font-weight: 800;
    color: #d97706;
    margin: 1rem 0;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
