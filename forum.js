const subjects = {
    "DIII Statistika": {
        "1": ["Pendidikan Agama", "Pengantar Demografi", "Pengantar Ekonomi", "Aljabar Linier", "Kalkulus", "Metode Statistika I"],
        "2": ["Pendidikan Pancasila dan Kewarganegaraan", "Pengantar Teknologi Informasi", "Pengantar Official Statistics", "Dasar-dasar Pemrograman", "Eksplorasi dan Visualisasi Data", "Statistika Matematika I", "Bahasa Inggris"],
        "3": ["Bahasa Indonesia", "Official Statistics", "Teknik Komunikasi", "Basis Data", "Metode Pengumpulan Data", "Metode Statistika II", "Statistika Matematika II", "Pengantar Sistem Informasi Geografis"],
        "4": ["Official Statistics Lanjutan", "Analisis Data Kategorik", "Analisis Regresi", "Komputasi Statistik", "Pengendalian Kualitas Statistik", "Teknik Penulisan Karya Ilmiah", "Laboratorium Survei", "Manajemen Survei"],
        "5": ["Analisis Peubah Ganda", "Analisis Data", "Manajemen SDM dan Perkantoran", "Metode Peramalan"],
    },
    "DIV Statistika": {
        "1": ["Pendidikan Agama", "Pengantar Demografi", "Pengantar Teknologi Informasi", "Aljabar Linier", "Kalkulus", "Metode Statistika I", "Bahasa Inggris I"],
        "2": ["Bahasa Indonesia", "Eksplorasi dan Visualisasi Data", "Algoritma dan Pemrograman", "Statistika Matematika I", "Bahasa Inggris II", "Pengantar Official Statistics", "Pengantar Ekonomi"],
        "3": ["Pendidikan Pancasila dan Kewarganegaraan", "Statistika Matematika II", "Metode Statistika II", "Metode Penarikan Sampel", "Komputasi Statistik", "Official Statistics", "Sistem Neraca Nasional"],
        "4": ["Pengantar Sains Data", "Basis Data", "Analisis Regresi", "Metode Penarikan Sampel Lanjutan", "Manajemen SDM dan Perkantoran", "Official Statistics Lanjutan", "Sistem Informasi Geografis"],
        "5": ["Analisis Data Kategorik", "Analisis Runtun Waktu", "Metode Penelitian", "Metode Survei", "Analisis Peubah Ganda", "Ekonomi Mikro", "Teknik Demografi"],
        "6": ["Data Mining dan Big Data", "Analisis Data Spasial", "Teknik Komunikasi", "Ekonomi Makro", "Ekonometika Terapan", "Sistem Neraca Nasional Lanjutan", "Pengantar Model Persamaan Struktural", "Analisis Tahan Hidup", "Analisis Data Kependudukan"],
        "7": ["Kapita Selekta Official Statistics Bidang Ekonomi", "Kapita Selekta Official Statistics Bidang Sosial dan Kependudukan"],
        "8": ["Pengantar Small Area Estimation"]
    },
    "DIV Komputasi Statistik": {
        "1": ["Pendidikan Agama", "Pengantar Demografi", "Pengantar Teknologi Informasi", "Aljabar Linier", "Kalkulus", "Metode Statistika I", "Bahasa Inggris I"],
        "2": ["Bahasa Indonesia", "Eksplorasi dan Visualisasi Data", "Algoritma dan Pemrograman", "Statistika Matematika I", "Bahasa Inggris II", "Pengantar Official Statistics", "Pengantar Ekonomi"],
        "3": ["Struktur Data", "Metode Statistika II", "Metode Penarikan Sampel", "Basis Data", "Pendidikan Pancasila dan Kewarnageraan", "Statistika Matematika II", "Sistem Informasi Geografis"],
        "4": ["Metode Numerik", "Pemrograman Berorientasi Objek", "Pemrograman Berbasis Web", "Analisis Regresi", "Komputasi Statistik", "Pengantar Official Statistik", "Metode Survei"],
        "5": ["Analisis Peubah Ganda", "Metodologi Penelitian", "Rekayasa Perangkat Lunak", "Official Statistics", "Analisis Runtun Waktu", "Information Retrieval", "Sistem Jaringan Komputer dan Data", "Pemrograman Platform Khusus"],
        "6": ["Data Mining", "Sistem Neraca Nasional", "Official Statistik Lanjutan", "Kecerdasan Buatan", "Visualisasi Data dan Informasi", "Teknologi Big Data", "Keamanan Sistem Informasi", "Teknologi Perekayasaan Data", "Interaksi Manusia dan Komputer"],
        "7": ["Manajemen SDM dan Perkantoran", "Teknik Komunikasi"],
    }
};

const updateSubjectDropdown = () => {
    const major = document.getElementById('threadMajor').value;
    const semester = document.getElementById('threadSemester').value;
    const subjectDropdown = document.getElementById('threadSubject');

    const filterMajor = document.getElementById('filter-major').value;
    const filterSemester = document.getElementById('filter-semester').value;
    const filterSubject = document.getElementById('filter-subject');

    // Clear the subject dropdowns
    subjectDropdown.innerHTML = '<option value="">select subject</option>';
    filterSubject.innerHTML = '<option value="">all subjects</option>';

    // Populate subject dropdown for new thread form
    if (major && semester && subjects[major] && subjects[major][semester]) {
        subjects[major][semester].forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            subjectDropdown.appendChild(option);
        });
    }

    // Populate subject dropdown for filter form
    if (filterMajor && filterSemester && subjects[filterMajor] && subjects[filterMajor][filterSemester]) {
        subjects[filterMajor][filterSemester].forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            filterSubject.appendChild(option);
        });
    }
};

document.getElementById('filter-major').addEventListener('change', () => {
    updateSubjectDropdown();
});
document.getElementById('filter-semester').addEventListener('change', () => {
    updateSubjectDropdown();
});

const renderThreads = (threads) => {
    const container = document.querySelector('ol#threadList');
    container.innerHTML = '';

    threads.forEach(thread => {
        const html = `
        <li class="row">
            <a href="thread.php?id=${thread.id}">
                <h4 class="title">${thread.content}</h4>
                <div class="bottom">
                    <p class="subject">${thread.subject}</p>
                    <p class="timestamp">${new Date(thread.date).toLocaleString()}</p>
                    <p class="comment-count">${thread.comments.length} comments</p>
                </div>
            </a>   
        </li>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    // Initially render all threads
    renderThreads(threads);

    // Update subject dropdowns when major or semester changes
    document.getElementById('threadMajor').addEventListener('change', updateSubjectDropdown);
    document.getElementById('threadSemester').addEventListener('change', updateSubjectDropdown);
    document.getElementById('filter-major').addEventListener('change', updateSubjectDropdown);
    document.getElementById('filter-semester').addEventListener('change', updateSubjectDropdown);

    // Initial call to update subject dropdowns
    updateSubjectDropdown();
});

function fetchThreads() {
    return fetch('fetch-threads.php')
        .then(response => response.json())
        .catch(error => {
            console.error('Error fetching threads:', error);
            return [];
        });
}

document.getElementById('filter-btn').addEventListener("click", () => {
    const filterSubjectValue = document.getElementById('filter-subject').value;
    fetchThreads().then(threads => {
        const filteredThreads = threads.filter(thread => {
            return (
                (filterSubjectValue === "" || thread.subject === filterSubjectValue)
            );
        });
        
        renderThreads(filteredThreads); // Update the UI with filtered threads
    });
});

const searchThreads = (query) => {
    fetchThreads().then(threads => {
        const filteredThreads = threads.filter(thread => {
            const threadContent = thread.content.toLowerCase();
            const threadAuthor = thread.author.toLowerCase();
            const threadSubject = thread.subject.toLowerCase();
            const searchQuery = query.toLowerCase();
            
            return threadContent.includes(searchQuery) || threadAuthor.includes(searchQuery) || threadSubject.includes(searchQuery);
        });

        renderThreads(filteredThreads);
    });
};

let debounceTimeout;
const debounce = (func, delay) => {
    return (...args) => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => func(...args), delay);
    };
};

const liveSearch = debounce((event) => {
    const searchInput = event.target.value;
    searchThreads(searchInput);
}, 300); // Adjust the debounce delay as needed

document.getElementById('search-input').addEventListener('keyup', liveSearch);