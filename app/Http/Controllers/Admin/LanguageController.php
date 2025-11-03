<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    public function index()
    {
        $locales = ['tr', 'en'];
        return view('admin.languages.index', compact('locales'));
    }

    public function edit($locale)
    {
        if (!in_array($locale, ['tr', 'en'])) {
            return redirect()->route('admin.languages.index')->with('error', 'Geçersiz dil seçimi.');
        }

        $filePath = resource_path("lang/{$locale}/messages.php");
        
        if (!File::exists($filePath)) {
            return redirect()->route('admin.languages.index')->with('error', 'Dil dosyası bulunamadı.');
        }

        $messages = require $filePath;
        
        return view('admin.languages.edit', compact('locale', 'messages'));
    }

    public function update(Request $request, $locale)
    {
        if (!in_array($locale, ['tr', 'en'])) {
            return redirect()->route('admin.languages.index')->with('error', 'Geçersiz dil seçimi.');
        }

        $filePath = resource_path("lang/{$locale}/messages.php");
        
        if (!File::exists($filePath)) {
            return redirect()->route('admin.languages.index')->with('error', 'Dil dosyası bulunamadı.');
        }

        $validated = $request->validate([
            'messages' => 'required|array',
            'messages.*' => 'nullable|string',
        ]);

        $messages = $validated['messages'];
        
        // Mevcut dosyayı oku ve anahtar sıralamasını koru
        $existingMessages = require $filePath;
        $orderedMessages = [];
        
        // Önce mevcut sırayı koru, sonra yeni eklenenleri ekle
        foreach ($existingMessages as $key => $oldValue) {
            $orderedMessages[$key] = $messages[$key] ?? $oldValue;
        }
        
        // Yeni eklenen anahtarları ekle
        foreach ($messages as $key => $value) {
            if (!isset($orderedMessages[$key])) {
                $orderedMessages[$key] = $value;
            }
        }
        
        // PHP dosyasını var_export ile oluştur (daha güvenli)
        $content = "<?php\n\nreturn " . var_export($orderedMessages, true) . ";\n";

        try {
            File::put($filePath, $content);
            return redirect()->route('admin.languages.edit', $locale)->with('success', 'Dil dosyası başarıyla güncellendi.');
        } catch (\Exception $e) {
            return redirect()->route('admin.languages.edit', $locale)->with('error', 'Dosya kaydedilirken bir hata oluştu: ' . $e->getMessage());
        }
    }
}

