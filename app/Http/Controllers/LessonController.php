<?php
namespace App\Http\Controllers;
use App\Models\Chapitre;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Log;




class LessonController extends Controller
{
    // Méthode pour afficher la liste des leçons
    public function index()
    {
        $lessons = Lesson::all();
        foreach ($lessons as $lesson) {
            $lesson->links = json_decode($lesson->link);
        }
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessons', compact('lessons', 'chapitres'));
    }

    // Méthode pour afficher le formulaire de création
    public function create(Request $request)
    {
        $chapitreId = $request->query('chapitre_id');
        $chapitres = Chapitre::all();
        return view('admin.apps.lesson.lessoncreate', compact('chapitres', 'chapitreId'));
    }

    // Méthode pour enregistrer une nouvelle leçon
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|date_format:H:i',
            'chapitre_id' => 'required|exists:chapitres,id',
            'uploaded_files' => 'required|json', // Fichiers uploadés via Dropzone
            'link' => 'required|string',
        ]);

        // Convertir les fichiers uploadés en tableau
        $uploadedFiles = json_decode($request->input('uploaded_files'), true);

        // Enregistrer les fichiers dans le stockage public
        $filePaths = [];
        foreach ($uploadedFiles as $file) {
            $newPath = 'files/' . basename($file['path']);
            Storage::disk('public')->move($file['path'], $newPath);
            $filePaths[] = $newPath;
        }

        // Enregistrer la leçon
        $lesson = new Lesson();
        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->duration = $request->input('duration');
        $lesson->file_path = json_encode($filePaths ?? []); // Toujours encoder un tableau, même vide
        $lesson->link = json_encode(explode("\n", $request->input('link')));
        $lesson->chapitre_id = $request->input('chapitre_id');
        $lesson->save();

        return redirect()->route('lessons')->with('success', 'Leçon ajoutée avec succès.');
    }

    // Méthode pour afficher une leçon
    public function show(Lesson $lesson)
    {
        return view('admin.apps.lesson.lessonshow', compact('lesson'));
    }


//el code el asli  
// public function edit(Lesson $lesson)
// {
//     $chapitres = Chapitre::all();

//     // Récupérer les fichiers existants
//     $existingFiles = [];
//     if (!empty($lesson->file_path)) {
//         $filePaths = json_decode($lesson->file_path, true);
//         foreach ($filePaths as $index => $filePath) {
//             if (Storage::disk('public')->exists($filePath)) {
//                 $existingFiles[] = [
//                     'id' => $index + 1, // Générer un ID unique
//                     'name' => basename($filePath), // Nom du fichier
//                     'path' => $filePath, // Chemin du fichier
//                     'size' => Storage::disk('public')->size($filePath), // Taille du fichier
//                     'url' => asset('storage/' . $filePath), // URL du fichier
//                 ];
//             }
//         }
//     }

//     return view('admin.apps.lesson.lessonedit', compact('lesson', 'chapitres', 'existingFiles'));
// }



// public function update(Request $request, Lesson $lesson)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'description' => 'required|string',
//         'duration' => 'required|date_format:H:i',
//         'chapitre_id' => 'required|exists:chapitres,id',
//         'uploaded_files' => 'nullable|json',
//         'link' => 'nullable|string',
//     ]);

//     $data = $request->all();

//     // Gestion des fichiers uploadés via Dropzone
//     if ($request->has('uploaded_files')) {
//         $uploadedFiles = json_decode($request->input('uploaded_files'), true);
//         $filePaths = [];
//         foreach ($uploadedFiles as $file) {
//             $newPath = $file['path']; // Utiliser le chemin existant si déjà dans le bon dossier
//             if (!str_starts_with($file['path'], 'files/')) {
//                 $newPath = 'files/' . basename($file['path']);
//                 Storage::disk('public')->move($file['path'], $newPath);
//             }
//             $filePaths[] = $newPath;
//         }
//         $data['file_path'] = json_encode($filePaths);
//     } else {
//         unset($data['file_path']);
//     }

//     // Gestion des liens
//     if (!empty($data['link'])) {
//         $links = array_map(function($link) {
//             $trimmed = trim($link);
//             if (!empty($trimmed) && !preg_match('/^https?:\/\//i', $trimmed)) {
//                 return 'http://' . $trimmed;
//             }
//             return $trimmed;
//         }, explode("\n", $data['link']));
//         $data['link'] = json_encode(array_filter($links));
//     } else {
//         $data['link'] = null;
//     }

//     $lesson->update($data);

//     return redirect()->route('lessons')->with('success', 'Leçon mise à jour avec succès.');
// }




//zedtou tww 


public function edit(Lesson $lesson)
{
    $chapitres = Chapitre::all();

    // Récupérer les fichiers existants
    $existingFiles = [];
    if (!empty($lesson->file_path)) {
        $filePaths = json_decode($lesson->file_path, true);
        if (is_array($filePaths)) {
            foreach ($filePaths as $index => $filePath) {
                if (Storage::disk('public')->exists($filePath)) {
                    $existingFiles[] = [
                        'id' => $index + 1, // Générer un ID unique
                        'name' => basename($filePath), // Nom du fichier
                        'path' => $filePath, // Chemin du fichier
                        'size' => Storage::disk('public')->size($filePath), // Taille du fichier
                        'url' => asset('storage/' . $filePath), // URL du fichier
                    ];
                }
            }
        }
    }

    return view('admin.apps.lesson.lessonedit', compact('lesson', 'chapitres', 'existingFiles'));
}


public function update(Request $request, Lesson $lesson)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|date_format:H:i',
        'chapitre_id' => 'required|exists:chapitres,id',
        'uploaded_files' => 'nullable|json',
        'link' => 'nullable|string',
    ]);

    $data = $request->all();

    // Gestion des fichiers uploadés via Dropzone
    if ($request->has('uploaded_files')) {
        $uploadedFiles = json_decode($request->input('uploaded_files'), true);
        if (is_array($uploadedFiles)) {
            $filePaths = [];
            foreach ($uploadedFiles as $file) {
                if (isset($file['path'])) {
                    $newPath = $file['path']; // Utiliser le chemin existant si déjà dans le bon dossier
                    if (!str_starts_with($file['path'], 'files/')) {
                        $newPath = 'files/' . basename($file['path']);
                        Storage::disk('public')->move($file['path'], $newPath);
                    }
                    $filePaths[] = $newPath;
                }
            }
            $data['file_path'] = json_encode($filePaths);
        }
    } else {
        unset($data['file_path']);
    }

    // Gestion des liens
    if (!empty($data['link'])) {
        $links = array_map(function($link) {
            $trimmed = trim($link);
            if (!empty($trimmed) && !preg_match('/^https?:\/\//i', $trimmed)) {
                return 'http://' . $trimmed;
            }
            return $trimmed;
        }, explode("\n", $data['link']));
        $data['link'] = json_encode(array_filter($links));
    } else {
        $data['link'] = null;
    }

    $lesson->update($data);

    return redirect()->route('lessons')->with('success', 'Leçon mise à jour avec succès.');
}


//zedtha tw 
public function deleteFile($lessonId) {
    try {
        // Récupérer la leçon spécifiée
        $lesson = Lesson::find($lessonId);
        
        if (!$lesson) {
            return response()->json(['success' => false, 'message' => 'Leçon non trouvée.'], 404);
        }
        
        // Vérifier si file_path existe
        if (empty($lesson->file_path)) {
            return response()->json(['success' => false, 'message' => 'Aucun fichier associé à cette leçon.'], 404);
        }
        
        // Supprimer le fichier physique
        if (Storage::exists($lesson->file_path)) {
            Storage::delete($lesson->file_path);
        }
        
        // Mettre à jour l'enregistrement dans la base de données
        $lesson->file_path = null; // Définir file_path à NULL
        $lesson->save();
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log l'erreur pour le débogage
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}
//zedtou tww


    public function previewDocx(Request $request)
    {
        $fileUrl = $request->fileUrl;
        
        try {
            // Pour convertir DOCX en HTML, vous pouvez utiliser une bibliothèque comme 
            // PhpWord ou simplement extraire le contenu XML et le formater
            // Ici, on utilise une approche simplifiée
            
            $tempFile = tempnam(sys_get_temp_dir(), 'docx_');
            file_put_contents($tempFile, file_get_contents($fileUrl));
            
            $content = $this->extractDocxContent($tempFile);
            unlink($tempFile);
            
            return response()->json([
                'success' => true,
                'content' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

    protected function extractDocxContent($file)
    {
        $zip = new ZipArchive();
        if ($zip->open($file) === true) {
            // Le contenu du document est généralement dans word/document.xml
            if (($index = $zip->locateName('word/document.xml')) !== false) {
                $content = $zip->getFromIndex($index);
                $zip->close();
                
                // Convertir XML en contenu HTML simple
                $xml = new \SimpleXMLElement($content);
                $namespace = $xml->getNamespaces(true);
                $xml->registerXPathNamespace('w', $namespace['w']);
                
                $paragraphs = $xml->xpath('//w:p');
                $html = '';
                
                foreach ($paragraphs as $p) {
                    $text = '';
                    $textNodes = $p->xpath('.//w:t');
                    
                    foreach ($textNodes as $textNode) {
                        $text .= (string)$textNode;
                    }
                    
                    if (!empty($text)) {
                        $html .= "<p>" . htmlspecialchars($text) . "</p>";
                    }
                }
                
                return $html;
            }
            $zip->close();
        }
        
        return '<p>Impossible d\'extraire le contenu du document.</p>';
    }

    
    public function previewZip(Request $request)
    {
        $fileUrl = $request->fileUrl;
        
        try {
            $tempFile = tempnam(sys_get_temp_dir(), 'zip_');
            file_put_contents($tempFile, file_get_contents($fileUrl));
            
            $zip = new ZipArchive();
            $files = [];
            
            if ($zip->open($tempFile) === true) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $stat = $zip->statIndex($i);
                    $files[] = [
                        'name' => $stat['name'],
                        'size' => $stat['size']
                    ];
                }
                $zip->close();
            }
            
            unlink($tempFile);
            
            return response()->json([
                'success' => true,
                'files' => $files
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Méthode pour supprimer une leçon
    public function destroy($id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lessonName = $lesson->title;
            $lesson->delete();
            return response()->json(['successMessage' => "La leçon '{$lessonName}' a été supprimée avec succès!"]);
        } catch (\Exception $e) {
            return response()->json(['errorMessage' => 'Une erreur est survenue.']);
        }
    }


    // Méthode pour uploader un fichier temporaire

    public function uploadTemp(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('temp', 'public');
        return response()->json([
            'id' => uniqid(),
            'filepath' => $path,
            'message' => 'File uploaded successfully' // Optionnel

        ]);
    }

    // Méthode pour supprimer un fichier temporaire
    public function deleteTemp(Request $request)
    {
        Storage::disk('public')->delete($request->filepath);
        return response()->json(['success' => true]);
    }

    //autre bsh njm nhel el word w el pdf f nfs page 
    public function getFile(Request $request)
{
    $filePath = $request->query('filepath');
    
    // Vérifiez si le chemin du fichier est sécurisé
    if (strpos($filePath, '..') !== false) {
        return response()->json(['error' => 'Invalid file path'], 400);
    }
    
    $fullPath = storage_path('app/public/' . $filePath);

    if (!file_exists($fullPath)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    // Obtenir l'extension du fichier
    $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
    $mimeType = null;

    // Définir le type MIME en fonction de l'extension
    switch (strtolower($extension)) {
        case 'pdf':
            $mimeType = 'application/pdf';
            break;
        case 'doc':
            $mimeType = 'application/msword';
            break;
        case 'docx':
            $mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            break;
        case 'xls':
            $mimeType = 'application/vnd.ms-excel';
            break;
        case 'xlsx':
            $mimeType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            break;
        case 'ppt':
            $mimeType = 'application/vnd.ms-powerpoint';
            break;
        case 'pptx':
            $mimeType = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
            break;
    }

    // Retourner le fichier avec le type MIME approprié s'il a été déterminé
    if ($mimeType) {
        return response()->file($fullPath, ['Content-Type' => $mimeType]);
    }

    // Pour les autres types, laisser le système déterminer le type MIME
    return response()->file($fullPath);
}


public function uploadFiles(Request $request, $lessonId) {
    try {
        // Récupérer la leçon spécifiée
        $lesson = Lesson::find($lessonId);
        
        if (!$lesson) {
            return response()->json(['success' => false, 'message' => 'Leçon non trouvée.'], 404);
        }
        
        // Valider les fichiers téléchargés
        $request->validate([
            'files.*' => 'required|file', // Permet plusieurs fichiers
        ]);
        
        // Récupérer les fichiers existants (ou initialiser un tableau vide)
        $existingFiles = $lesson->file_path ?? [];
        
        // Traiter chaque fichier téléchargé
        foreach ($request->file('files') as $file) {
            // Stocker le fichier et obtenir le chemin
            $filePath = $file->store('uploads');
            
            // Ajouter le nouveau fichier au tableau des fichiers existants
            $existingFiles[] = $filePath;
        }
        
        // Mettre à jour l'enregistrement dans la base de données
        $lesson->file_path = $existingFiles;
        $lesson->save();
        
        return response()->json(['success' => true, 'file_paths' => $existingFiles]);
    } catch (\Exception $e) {
        // Log l'erreur pour le débogage
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


//zedtha tww 

// public function convertPptxToPdf(Request $request)
// {
//     $request->validate([
//         'file' => 'required|mimes:ppt,pptx'
//     ]);

//     $file = $request->file('file');
//     $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//     $inputPath = $file->storeAs('temp', $fileName . '.' . $file->getClientOriginalExtension());
//     $outputPath = storage_path('app/temp/' . $fileName . '.pdf');

//     // Chemin complet de l'exécutable LibreOffice sur Windows
//     $libreOfficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"';

//     // Commande pour convertir le fichier PPTX en PDF
//     $command = $libreOfficePath . " --headless --convert-to pdf --outdir " . storage_path('app/temp') . " " . storage_path('app/' . $inputPath);

//     $process = new Process(explode(' ', $command));
//     $process->run();

//     if (!$process->isSuccessful()) {
//         throw new ProcessFailedException($process);
//     }

//     return response()->file($outputPath)->deleteFileAfterSend(true);
// }

}







    


 

















