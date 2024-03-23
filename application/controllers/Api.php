<?php
header("Content-Type: application/json; charset=utf-8");
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use React\EventLoop\Factory;
use React\Promise\Deferred;
use Ramsey\Uuid\Uuid;
Use Sentiment\Analyzer;
use Stichoza\GoogleTranslate\GoogleTranslate;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Spatie\PdfToImage\Pdf;


require_once 'vendor/autoload.php';

class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('Sastrawi_helper');
        $this->load->library('password');
    } 

    public function uploadDosen() {
        // Konfigurasi upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 5120;
    
        $this->load->library('upload', $config);
    
        // Lakukan upload file
        if (!$this->upload->do_upload('jawaban_dosen')) {
            $error = $this->upload->display_errors();
            log_message('error', 'Upload Error: ' . $error);
            return $this->output->set_status_header(400)->set_output(json_encode(['message' => $error]));
        }
    
        // Ambil data upload
        $upload_data = $this->upload->data();
        $path = 'uploads/' . $upload_data['file_name'];
    
        // Baca konten PDF
        $pdfContent = file_get_contents($path);
        if (empty($pdfContent)) {
            unlink($path); // Hapus file kosong
            return $this->output->set_status_header(400)->set_output(json_encode(['message' => 'PDF is empty']));
        }
    
        // Parse konten PDF
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseContent($pdfContent);
        $pdfText = $pdf->getText();
    
        // Extract pertanyaan dari PDF
        preg_match_all('/\(\d+\)\s*\.+\s*(.*?)\s*\?/s', $pdfText, $questionMatches);
        $questions = $questionMatches[1];
    
        // Extract jawaban dari PDF
        preg_match_all('/\(\d+\)\s*\.+\s*(.*?)(?=\(\d+\)|$)/s', $pdfText, $answerMatches);
        $answers = $answerMatches[1];
        
    
        // Validasi jika tidak ada soal dan jawaban
        if (empty($questions) || empty($answers)) {
            unlink($path); // Hapus file
            return $this->output->set_status_header(400)->set_output(json_encode(['message' => 'No questions and answers found in PDF. Please adjust the format']));
        }
    
        // Gabungkan semua pertanyaan ke dalam satu string
        $questionText = implode("\n", $questions);
    
        // Gabungkan semua jawaban ke dalam satu string
        $answerText = implode("\n", $answers);
        
        $answerText = preg_replace('/.*Jawa\s+ban\s*:\s*/s', '', $answerText);


        // var_dump($answerText);
        // die;
    
        // Data untuk disimpan
        $data = [
            'nip' => $this->input->post('nip'),
            'soal' => $questionText,
            'jawaban_dosen' => $path,
            'teks_jawaban' => $answerText,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'), 
        ];
    
        // Simpan data
        $this->Model->createDosen($data);
    
        // Response
        return $this->output->set_status_header(200)->set_output(json_encode($data));
    }
    
    
    
    


public function uploadMahasiswa() {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'pdf';
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 5120;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('jawaban_mahasiswa')) {
        $error = $this->upload->display_errors();
        log_message('error', 'Upload Error: ' . $error);
        return $this->output->set_status_header(400)->set_output(json_encode(['message' => $error]));
    }

    $upload_data = $this->upload->data();
    $path = 'uploads/' . $upload_data['file_name'];

    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($path);
    $pdfText = $pdf->getText();;
 
     // Extract jawaban dari PDF
     preg_match_all('/\(\d+\)\s*\.+\s*(.*?)(?=\(\d+\)|$)/s', $pdfText, $answerMatches);
     $answers = $answerMatches[1];
     
     // Validasi jika tidak ada soal dan jawaban
     if (empty($answers)) {
         unlink($path); // Hapus file
         return $this->output->set_status_header(400)->set_output(json_encode(['message' => 'No questions and answers found in PDF. Please adjust the format']));
     }
 
     // Gabungkan semua jawaban ke dalam satu string
     $answerText = implode("\n", $answers);
     
     $answerText = preg_replace('/.*Jawa\s+ban\s*:\s*/s', '', $answerText);

    //  var_dump($answerText);
    //  die;
    

    $data = [
        'npm' => $this->input->post('npm'),
        'jawaban_mahasiswa' => $path,
        'teks_jawaban' => $answerText,
        'created_at' => date('Y-m-d H:i:s'), 
        'updated_at' => date('Y-m-d H:i:s'), 
    ];

    $this->Model->createMahasiswa($data);

    return $this->output->set_status_header(200)->set_output(json_encode($data));
}

public function compare() {
    $request_body = $this->input->raw_input_stream;
    $request_data = json_decode($request_body, true);

    if (isset($request_data['mahasiswa_id'])) {
        $dosen_id = $this->input->get('dosen_id');
        $mahasiswa_ids = $request_data['mahasiswa_id'];

        $jawabanDosen = $this->Model->getDataModel('jawaban_dosen', array('dosen_id', 'teks_jawaban'), array('dosen_id' => $dosen_id));

        if (empty($jawabanDosen)) {
            return $this->output->set_status_header(404)->set_output(json_encode(['message' => 'Jawaban dosen tidak ditemukan']));
        }

        $result = [];

        foreach ($mahasiswa_ids as $mahasiswa_id) {
            // Ambil data jawaban mahasiswa
            $jawabanMahasiswa = $this->Model->getDataModel('jawaban_mahasiswa', array('mahasiswa_id', 'teks_jawaban'), array('mahasiswa_id' => $mahasiswa_id));
        
            if (empty($jawabanMahasiswa)) {
                return $this->output->set_status_header(404)->set_output(json_encode(['message' => 'Jawaban Mahasiswa tidak ditemukan']));
            }
        
            $processedText = $this->autocorrect($jawabanMahasiswa[0]['teks_jawaban'], $jawabanDosen[0]['teks_jawaban'], 1); 
            $damerau = $this->DamerauLevenshteinDistance($processedText, $jawabanDosen[0]['teks_jawaban']);
            $similarity = $this->calculateCosineSimilarity($jawabanDosen[0]['teks_jawaban'], $processedText);
            $nilai = $this->calculateScore($similarity, $damerau);
        
            $result[] = [
                'mahasiswa_id' => $mahasiswa_id,
                'jawaban_dosen' => $jawabanDosen[0]['teks_jawaban'],
                'jawaban_mahasiswa' => $processedText, 
                'nilai_similaritas' => $similarity,
                'nilai_katakunci' => $nilai,
            ];
        }        

        return $this->output->set_status_header(200)->set_output(json_encode(['message' => 'Berhasil menghitung nilai', 'data' => $result]));
    } else {
        return $this->output->set_status_header(400)->set_output(json_encode(['message' => 'Parameter tidak valid']));
    }
}

private function calculateScore($similarity, $damerau, $threshold = 5) {
    $score = $similarity * 0.7;

    if ($damerau > $threshold) {
        $score += 0.3; 
    } else {
        $score += (1 / ($damerau + 1)) * 0.3; 
    }

    $scaled_score = $score;
    
    return $scaled_score;
}


private function calculateCosineSimilarity($str1, $str2) {
    $stopWordsFilePath = APPPATH . 'models/stop-words.txt';
    $stopWords = file($stopWordsFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // mentokenisasi string
    $tokens1 = str_word_count(strtolower($str1), 1);
    $tokens2 = str_word_count(strtolower($str2), 1);

    // menghapus stopwords dari token
    $tokens1 = array_diff($tokens1, $stopWords);
    $tokens2 = array_diff($tokens2, $stopWords);

    // menghitung vektor
    $vector1 = array_count_values($tokens1);
    $vector2 = array_count_values($tokens2);

    // menghitung dot product
    $dotProduct = 0;
    foreach ($vector1 as $term => $count) {
        if (isset($vector2[$term])) {
            $dotProduct += $count * $vector2[$term];
        }
    }

    // menghitung panjang vektor
    $length1 = sqrt(array_sum(array_map(function ($x) { return $x * $x; }, array_values($vector1))));
    $length2 = sqrt(array_sum(array_map(function ($x) { return $x * $x; }, array_values($vector2))));

    // menghitung cosine similarity
    if ($length1 > 0 && $length2 > 0) {
        $cosineSimilarity = $dotProduct / ($length1 * $length2);
    } else {
        $cosineSimilarity = 0; // menghindari pembagian oleh nol
    }

    return $cosineSimilarity;
}


private function DamerauLevenshteinDistance($str1, $str2) {
    $str1 = strtolower($str1);
    $str2 = strtolower($str2);

    $len1 = strlen($str1);
    $len2 = strlen($str2);

    $d = array();

    for ($i = 0; $i <= $len1; $i++) {
        $d[$i] = array();
        for ($j = 0; $j <= $len2; $j++) {
            $d[$i][$j] = 0;
        }
    }

    for ($i = 0; $i <= $len1; $i++) {
        $d[$i][0] = $i;
    }

    for ($j = 0; $j <= $len2; $j++) {
        $d[0][$j] = $j;
    }

    for ($i = 1; $i <= $len1; $i++) {
        $char1 = $str1[$i - 1];
        for ($j = 1; $j <= $len2; $j++) {
            $char2 = $str2[$j - 1];
            $cost = ($char1 != $char2) ? 1 : 0;
            $d[$i][$j] = min(
                $d[$i - 1][$j] + 1,         // Deletion
                $d[$i][$j - 1] + 1,         // Insertion
                $d[$i - 1][$j - 1] + $cost  // Substitution
            );
            // Transpose
            if ($i > 1 && $j > 1 && $char1 == $str2[$j - 2] && $str1[$i - 2] == $char2) {
                $d[$i][$j] = min($d[$i][$j], $d[$i - 2][$j - 2] + $cost);
            }
        }
    }

    return $d[$len1][$len2];
}

private function autocorrect($text, $target, $threshold = 1) {
    $wordsText = preg_split('/\s+/', $text);
    $wordsTarget = preg_split('/\s+/', $target);

    $correctedText = $text;

    foreach ($wordsText as $index => $word) {
        foreach ($wordsTarget as $targetWord) {
            // Memeriksa jarak Levenshtein antara kata dalam teks dan kata target
            $levDistance = levenshtein(strtolower($word), strtolower($targetWord));
            
            // Jika jarak Levenshtein kurang dari atau sama dengan threshold, ganti kata dalam teks
            if ($levDistance <= $threshold) {
                $correctedText = str_replace($word, $targetWord, $correctedText);
                break; // Lanjut ke kata berikutnya setelah mengganti
            }
        }
    }

    return $correctedText;
}

private function generateTextSuggestions($text1, $text2) {
    $suggestions = [];
    $words1 = preg_split('/\s+/', strtolower($text1));
    $words2 = preg_split('/\s+/', strtolower($text2));

    foreach ($words2 as $word2) {
        if (!in_array($word2, $words1)) {
            $suggestedWord = $this->findClosestWord($word2, $words1);
            if ($suggestedWord !== "" && strtolower($word2) !== $suggestedWord) {
                $suggestions[] = [
                    'original' => $word2,
                    'suggested' => $suggestedWord,
                ];
            }
        }
    }

    return $suggestions;
}


private function findClosestWord($word, $words) { 
    $minDistance = PHP_INT_MAX;
    $closestWord = "";

    $word = strtolower($word);

    foreach($words as $candidate) { 
        $candidate = strtolower($candidate);
        $distance = levenshtein($word, $candidate);

        if ($distance < $minDistance) {
            $minDistance = $distance;
            $closestWord = $candidate;
        }
    }

    return $closestWord;
}



// private function hitungNilaiSimilaritas($teksDosen, $teksMahasiswa) {
//     $teksDosen = strtolower($teksDosen);
//     $teksMahasiswa = strtolower($teksMahasiswa);

//     $damerauLevenshteinDistance = $this->calculateDamerauLevenshteinDistance($teksDosen, $teksMahasiswa);

// 	$translatedTextMahasiswa = $this->DiTranslate($teksMahasiswa);
	

//     // Menghitung analisis sentimen menggunakan PHP-Sentiment-Analyzer
//     $analyzer = new Analyzer();
//     $sentimentDosen = $analyzer->getSentiment($teksDosen);
//     $sentimentMahasiswa = $analyzer->getSentiment($translatedTextMahasiswa);

//     // Menghitung skor Cosine Similarity
//     $maxPossibleDistance = max(strlen($teksDosen), strlen($teksMahasiswa));
//     $similarityScore = 1 - ($damerauLevenshteinDistance / $maxPossibleDistance);

//     // Anda dapat menggunakan nilai sentimen atau similarityScore sesuai kebutuhan Anda
//     return [
//         'sentiment_dosen' => $sentimentDosen,
//         'sentiment_mahasiswa' => $sentimentMahasiswa,
//         'similarity_score' => $similarityScore,
//     ];
// }

// private function DiTranslate($str) {
//     $translator = new GoogleTranslate('en');
//     $translatedText = $translator->translate($str);
    
//     return $translatedText;
// }



// private function hitungNilaiSimilaritas($teksDosen, $teksMahasiswa) {
//     // Preprocessing
//     $teksDosen = strtolower($teksDosen);
//     $teksMahasiswa = strtolower($teksMahasiswa);

//     // Tokenisasi
//     $tokenDosen = preg_split('/\s+/', $teksDosen, -1, PREG_SPLIT_NO_EMPTY);
//     $tokenMahasiswa = preg_split('/\s+/', $teksMahasiswa, -1, PREG_SPLIT_NO_EMPTY);

//     // Stemming
//     $stemmedDosen = array_map('stem_text', $tokenDosen);
//     $stemmedMahasiswa = array_map('stem_text', $tokenMahasiswa);


//     // Hitung similarity tanpa bobot kata dosen
//     $dotProduct = 0;
//     $panjangVektorDosen = 0;
//     $panjangVektorMahasiswa = 0;

//     foreach ($stemmedDosen as $kata) {
//         if (in_array($kata, $stemmedMahasiswa)) {
//             $dotProduct++;
//         }
//         $panjangVektorDosen++;
//     }

//     foreach ($stemmedMahasiswa as $kata) {
//         $panjangVektorMahasiswa++;
//     }

//     $panjangVektorDosen = sqrt($panjangVektorDosen);
//     $panjangVektorMahasiswa = sqrt($panjangVektorMahasiswa);

// 	// var_dump($panjangVektorDosen);
// 	// var_dump($panjangVektorMahasiswa);

//     // Menghitung cosine similarity
//     if ($panjangVektorDosen != 0 && $panjangVektorMahasiswa != 0) {
//         $cosineSimilarity = $dotProduct / ($panjangVektorDosen * $panjangVektorMahasiswa);
//     } else {
//         $cosineSimilarity = 0; // Handle pembagian dengan nol
//     }

//     // Mengembalikan nilai similarity sebagai float
//     return $cosineSimilarity;
// }


}
 