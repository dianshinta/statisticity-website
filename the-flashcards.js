const container = document.querySelector(".container");
const addQuestionCard = document.getElementById("add-question-card");
const cardButton = document.getElementById("save-btn");
const id = document.getElementById("flashcard-id");
const major = document.getElementById("major");
const semester = document.getElementById("semester");
const subject = document.getElementById("subject");
const question = document.getElementById("question");
const answer = document.getElementById("answer");
const errorMessage = document.getElementById("error");
const addQuestion = document.getElementById("add-flashcard");
const closeBtn = document.getElementById("close-btn");
const filterMajor = document.getElementById("filter-major");
const filterSemester = document.getElementById("filter-semester");
const filterSubject = document.getElementById("filter-subject");
const filterBtn = document.getElementById("filter-btn");

let editBool = false;
const flashcards = [];

// Update subject options based on major and semester
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
        "7": ["Manajemen SDM dan Perkantoran", "Teknik Komunikasi"]
    }
};

const updateSubjectDropdown = (dropdown, selectedMajor, selectedSemester) => {
    dropdown.innerHTML = '<option value="">Select Subject</option>'; // Reset subject options
    if (selectedMajor && selectedSemester && subjects[selectedMajor] && subjects[selectedMajor][selectedSemester]) {
        subjects[selectedMajor][selectedSemester].forEach(subj => {
            const option = document.createElement("option");
            option.value = subj;
            option.textContent = subj;
            dropdown.appendChild(option);
        });
    }
};

major.addEventListener("change", () => updateSubjectDropdown(subject, major.value, semester.value));
semester.addEventListener("change", () => updateSubjectDropdown(subject, major.value, semester.value));

filterMajor.addEventListener("change", () => updateSubjectDropdown(filterSubject, filterMajor.value, filterSemester.value));
filterSemester.addEventListener("change", () => updateSubjectDropdown(filterSubject, filterMajor.value, filterSemester.value));

// Add question when user clicks 'Add Flashcard' button
addQuestion.addEventListener("click", () => {
    major.value = "";
    semester.value = "";
    subject.innerHTML = '<option value="">Select Subject</option>';
    question.value = "";
    answer.value = "";
    id.value = '';
    addQuestionCard.classList.remove("hide");
});

// Hide Create flashcard Card
closeBtn.addEventListener("click", () => {
    container.classList.remove("hide");
    addQuestionCard.classList.add("hide");
    if (editBool) {
        editBool = false;
        submitQuestion();
    }
});



function fetchFlashcards() {
    return fetch('fetch-flashcards.php')
        .then(response => response.json())
        .then(data => {
            console.log("Fetched flashcards:", data); // Add this line to check fetched data
            return data;
        })
        .catch(error => {
            console.error('Error fetching flashcards:', error);
            return [];
        });
}

// Fetch flashcards from the server and display them
function viewList() {
    const listCard = document.querySelector(".card-list-container");
    listCard.innerHTML = ""; // Clear existing flashcards

    fetchFlashcards().then(flashcards => {
        flashcards.forEach(flashcard => {
            const div = document.createElement("div");
            div.classList.add("card");

            // Major, Semester, and Subject
            div.innerHTML += `<p class="info-div">${flashcard.major} - Semester ${flashcard.semester}</p>`;
            // div.innerHTML += `<p class="info-div"></p>`;
            div.innerHTML += `<p class="info-div"><strong>${flashcard.subject}</strong> </p>`;
            // Question
            div.innerHTML += `<br><p class="question-div">${flashcard.question}</p>`;

            // Answer
            const displayAnswer = document.createElement("p");
            displayAnswer.classList.add("answer-div", "hide");
            displayAnswer.innerText = flashcard.answer;

            // Link to show/hide answer
            const link = document.createElement("a");
            link.setAttribute("href", "#");
            link.setAttribute("class", "show-hide-btn");
            link.innerHTML = "show";
            link.addEventListener("click", (event) => {
                event.preventDefault();
                
                displayAnswer.classList.toggle("hide");
                link.innerHTML = displayAnswer.classList.contains("hide") ? "show" : "hide";
            });
            div.appendChild(link);
            div.appendChild(displayAnswer);

            // Edit and Delete buttons
            const buttonsCon = document.createElement("div");
            buttonsCon.classList.add("buttons-con");

            const editButton = document.createElement("button");
            editButton.setAttribute("class", "edit");
            editButton.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;
            editButton.addEventListener("click", () => {
                editBool = true;
                loadFlashcardForEdit(flashcard);
                addQuestionCard.classList.remove("hide");
            });
            buttonsCon.appendChild(editButton);

            const deleteButton = document.createElement("button");
            deleteButton.setAttribute("class", "delete");
            deleteButton.innerHTML = `<i class="fa-solid fa-trash-can"></i>`;
            deleteButton.addEventListener("click", (event) => {
                event.preventDefault();
                deleteFlashcard(flashcard);
            });
            buttonsCon.appendChild(deleteButton);

            div.appendChild(buttonsCon);
            listCard.appendChild(div);
        });
    });
}

// Load flashcard data into the form for editing
function loadFlashcardForEdit(flashcard) {
    major.value = flashcard.major;
    semester.value = flashcard.semester;
    updateSubjectDropdown(subject, major.value, semester.value);
    subject.value = flashcard.subject;
    question.value = flashcard.question;
    answer.value = flashcard.answer;
    document.getElementById("flashcard-id").value = flashcard.id; // Set flashcard ID for editing
}

// Function to handle flashcard deletion
function deleteFlashcard(flashcard) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "delete-flashcard.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("Response from server:", xhr.responseText);
            if (xhr.responseText === "success") {
                viewList();
            } else {
                console.error("Failed to delete flashcard. Please try again.");
            }
        }
    };
    xhr.send(`id=${encodeURIComponent(flashcard.id)}`);
}

// Function to handle flashcard submission (add/edit)
cardButton.addEventListener("click", (event) => {
    event.preventDefault();

    const tempMajor = major.value;
    const tempSemester = semester.value;
    const tempSubject = subject.value;
    const tempQuestion = question.value;
    const tempAnswer = answer.value;
    const flashcardId = id.value;

    console.log("Submitting flashcard with values:", { tempMajor, tempSemester, tempSubject, tempQuestion, tempAnswer });

    if (!tempMajor || !tempSemester || !tempSubject || !tempQuestion || !tempAnswer) {
        errorMessage.classList.remove("hide");
        console.log("All fields are required.");
    } else {
        errorMessage.classList.add("hide");
        
        const url = flashcardId ? "update-flashcard.php" : "add-flashcard.php";

        // Save flashcard to the database using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Response from server:", xhr.responseText);
                if (xhr.responseText === "success") {
                    viewList();
                    addQuestionCard.classList.add("hide");
                } else {
                    viewList();
                    addQuestionCard.classList.add("hide");
                }
            }
        };
        xhr.send(`id=${encodeURIComponent(flashcardId)}&major=${encodeURIComponent(tempMajor)}&semester=${encodeURIComponent(tempSemester)}&subject=${encodeURIComponent(tempSubject)}&question=${encodeURIComponent(tempQuestion)}&answer=${encodeURIComponent(tempAnswer)}`);
    }

});

// Call viewList when the page loads
document.addEventListener('DOMContentLoaded', viewList);



// Filter function
filterBtn.addEventListener("click", () => {
    const filterMajorValue = filterMajor.value;
    const filterSemesterValue = filterSemester.value;
    const filterSubjectValue = filterSubject.value;
    fetchFlashcards().then(flashcards => {
        const filteredFlashcards = flashcards.filter(flashcard => {
            return (
                (filterMajorValue === "" || flashcard.major === filterMajorValue) &&
                (filterSemesterValue === "" || flashcard.semester === filterSemesterValue) &&
                (filterSubjectValue === "" || flashcard.subject === filterSubjectValue)
            );
        });

        const listCard = document.querySelector(".card-list-container");
        listCard.innerHTML = ""; // Clear existing flashcards
        filteredFlashcards.forEach(flashcard => {
            const div = document.createElement("div");
            div.classList.add("card");

            // Major, Semester, and Subject
            div.innerHTML += `<p class="info-div">${flashcard.major} - Semester ${flashcard.semester}</p>`;
            // div.innerHTML += `<p class="info-div"></p>`;
            div.innerHTML += `<p class="info-div"><strong>${flashcard.subject}</strong> </p>`;
            // Question
            div.innerHTML += `<br><p class="question-div">${flashcard.question}</p>`;

            // Answer
            const displayAnswer = document.createElement("p");
            displayAnswer.classList.add("answer-div", "hide");
            displayAnswer.innerText = flashcard.answer;

            // Link to show/hide answer
            const link = document.createElement("a");
            link.setAttribute("href", "#");
            link.setAttribute("class", "show-hide-btn");
            link.innerHTML = "show";
            link.addEventListener("click", (event) => {
                event.preventDefault();
                
                displayAnswer.classList.toggle("hide");
                link.innerHTML = displayAnswer.classList.contains("hide") ? "show" : "hide";
            });
            div.appendChild(link);
            div.appendChild(displayAnswer);

            // Edit and Delete buttons
            const buttonsCon = document.createElement("div");
            buttonsCon.classList.add("buttons-con");

            const editButton = document.createElement("button");
            editButton.setAttribute("class", "edit");
            editButton.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;
            editButton.addEventListener("click", (event) => {
                event.preventDefault();
                editBool = true;
                loadFlashcardForEdit(flashcard);
                addQuestionCard.classList.remove("hide");
            });
            buttonsCon.appendChild(editButton);

            const deleteButton = document.createElement("button");
            deleteButton.setAttribute("class", "delete");
            deleteButton.innerHTML = `<i class="fa-solid fa-trash-can"></i>`;
            deleteButton.addEventListener("click", (event) => {
                event.preventDefault();
                deleteFlashcard(flashcard);
            });
            buttonsCon.appendChild(deleteButton);

            div.appendChild(buttonsCon);
            listCard.appendChild(div);
        });
    });
});