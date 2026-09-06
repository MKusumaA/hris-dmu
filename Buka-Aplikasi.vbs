Set WshShell = CreateObject("WScript.Shell")

' 1. Memaksa sistem membaca folder tempat file ini berada secara akurat
WshShell.CurrentDirectory = CreateObject("Scripting.FileSystemObject").GetParentFolderName(WScript.ScriptFullName)

' 2. Menyalakan server lokal menggunakan PHP Portable
WshShell.Run "cmd /c php-portable\php.exe artisan serve", 0, False

' 3. Memberi waktu loading 4 detik (4000 milidetik) agar mesin benar-benar siap
WScript.Sleep 4000

' 4. Membuka Google Chrome
WshShell.Run "chrome --app=""http://127.0.0.1:8000"""