<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel File Upload API with Postman

![Laravel Icon](https://img.icons8.com/fluency/48/laravel.png) ![Postman Icon](https://img.icons8.com/fluency/48/postman-api.png)

This project demonstrates how to create a file upload API using Laravel, which can be tested using Postman. Follow the steps below to set up the project and understand its functionality.

---

## 🌟 Features  
- 🗂️ **File upload API endpoint**  
- 🗃️ **Saves files to a specific folder**  
- ✅ **Handles validation for file types and sizes**  
- 📝 **Returns meaningful responses for success and failure cases**

---

## 🛠️ Requirements  
![Requirements Icon](https://img.icons8.com/fluency/48/requirement.png)  
- PHP >= 8.0  
- Composer  
- Laravel >= 10.x  
- Postman (for testing)  

---

## 📂 Setup Instructions  

### Step 1: 🔄 Clone the Repository  
Clone this repository to your local machine:
```bash
git clone [your-repository-url]
```

Navigate into the project directory:
```bash
cd [your-project-directory]
```

### Step 2: 📦 Install Dependencies  
Run the following command to install all dependencies:
```bash
composer install
```

### Step 3: ⚙️ Configure Environment Variables  
Create a `.env` file in the root of the project (if it doesn't exist) and configure the following:
```env
APP_NAME="Laravel File Upload"
APP_ENV=local
APP_KEY=base64:your-app-key
APP_DEBUG=true
APP_URL=http://localhost

FILESYSTEM_DISK=public
```

### Step 4: 🔑 Generate App Key  
Run the following command to generate the application key:
```bash
php artisan key:generate
```

### Step 5: 🔗 Create Storage Symlink  
Link the public storage directory to the `/storage` folder using:
```bash
php artisan storage:link
```

### Step 6: 📁 Create Folder for Uploaded Files  
Run the following command to create the necessary directory:
```bash
mkdir -p storage/app/public/uploads
```

---

## 🔗 API Endpoints  

### 📤 File Upload Endpoint  
**URL:** `/api/upload`  
**Method:** `POST`  
**Headers:**  
- `Accept: application/json`  
- `Content-Type: multipart/form-data`  

**Parameters:**  
- `file` (required): The file to upload.  

**Validation Rules:**  
- File size must not exceed 2MB.  
- Allowed file types: `.jpg`, `.png`, `.pdf`.  

---

## 🔍 Code Overview  

### 📂 Controller  
The `FileUploadController` handles the upload logic:  
```php
public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:jpg,png,pdf|max:2048',
    ]);

    $fileName = time() . '.' . $request->file->extension();
    $request->file->storeAs('public/uploads', $fileName);

    return response()->json([
        'success' => true,
        'message' => 'File uploaded successfully!',
        'file_path' => asset('storage/uploads/' . $fileName),
    ]);
}
```

### 📜 Routes  
The API route is defined in `routes/api.php`:  
```php
use App\Http\Controllers\FileUploadController;

Route::post('/upload', [FileUploadController::class, 'upload']);
```

---

## 🧪 Testing  

### 🧰 Using Postman  
1. Open Postman and create a new request.  
2. Select `POST` method.  
3. Use the endpoint `http://localhost/api/upload`.  
4. In the `Body` section, select `form-data` and add the key `file` with the file to upload.  

---

## 🚨 Troubleshooting  
If you encounter any issues:  
1. Ensure the Laravel storage symlink is set up (`php artisan storage:link`).  
2. Check file permissions for the `storage` and `public` directories.  
3. Review the logs in `storage/logs/laravel.log`.  

---

## 📜 License  
![License Icon](https://img.icons8.com/fluency/48/license.png)  
This project is licensed under the [MIT License](LICENSE).

