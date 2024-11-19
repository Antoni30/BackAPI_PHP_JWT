## Endpoints

### 1. **Leer un usuario (GET)**

metodo GET :http://localhost:8000/api/read_user.php?id=1

### 2. **Login (POST)**
metodo POST: http://localhost:8000/api/login.php
```json
{
  "username": "username",
  "password": "password"
}
```
### 3. **Crear Usuario (POST)**
metodo POST: http://localhost:8000/api/crear_user.php
```json
{
  "username": "admin",
  "password": "adminadmin123",
  "email": "admin@espe.edu.ec",
  "nombre_completo": "Admin Admin"
}
```

### 1. **Actualizar usuario (PUT)**
metodo PUT: http://localhost:8000/api/update_user.php
```json
{
  "id": 1,
  "username": "antoni",
  "email": "artoapanta@espe.edu.ec",
  "nombre_completo": "Antoni Toapanta"
}
```
### 1. **Eliminar usuario (DELETE)**
metodo DELETE: http://localhost:8000/api/delete_user.php?id=2" 
