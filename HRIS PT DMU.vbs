Set WshShell = CreateObject("WScript.Shell")
WshShell.CurrentDirectory = CreateObject("Scripting.FileSystemObject").GetParentFolderName(WScript.ScriptFullName)

' Menyalakan server lokal
WshShell.Run "cmd /c php-portable\php.exe artisan serve", 0, False

' Waktu tunggu dipangkas dari 4 detik menjadi 2 detik saja
WScript.Sleep 2000

' Membuka Chrome dengan perintah anti-zoom (force-device-scale-factor) dan langsung layar penuh
WshShell.Run "chrome --app=""http://127.0.0.1:8000"" --start-maximized --force-device-scale-factor=1"