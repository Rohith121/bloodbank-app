# 🩸 Blood Bank Application

A PHP + MySQL based Blood Bank Management System deployed on Kubernetes using Docker, GitHub Actions CI/CD, StatefulSets, Deployments, ConfigMaps, Secrets, Persistent Volumes, and Services.

---

# 📌 Architecture

```
                    Browser
                       │
                       ▼
               NodePort / Ingress
                       │
                       ▼
              bloodbank-app-service
                 (ClusterIP)
                       │
                 Deployment
                 (PHP + Apache)
                       │
                       ▼
                 CoreDNS Lookup
              bloodbank-db Service
                 (ClusterIP)
                       │
                  StatefulSet
                      MySQL
                       │
                Persistent Volume
```

---

# 🚀 Technologies Used

- PHP 7.2
- Apache
- MySQL 8
- Docker
- Docker Hub
- Kubernetes
- GitHub Actions
- StatefulSet
- Deployment
- ConfigMap
- Secret
- Persistent Volume
- NodePort
- Ingress (Optional)

---

# 📂 Project Structure

```
bloodbank/
│
├── app/
│   ├── index.php
│   ├── signup.php
│   ├── config.php
│   ├── search.php
│   ├── donate-blood.php
│   └── ...
│
├── database/
│   ├── Dockerfile
│   └── init.sql
│
├── kubernetes/
│   ├── namespace.yaml
│   ├── configmap.yaml
│   ├── secret.yaml
│   ├── app-deployment.yaml
│   ├── db-statefulset.yaml
│   ├── app-service.yaml
│   ├── db-service.yaml
│   ├── ingress.yaml
│   └── pvc.yaml
│
├── .github/
│   └── workflows/
│       └── ci-cd.yml
│
├── Dockerfile
└── README.md
```

---

# ⚙️ Prerequisites

- Docker
- Kubernetes Cluster
- kubectl
- Git
- Docker Hub Account
- GitHub Repository

---

# 🐳 Build Docker Images

Application

```bash
docker build -t <dockerhub-username>/blood-bankapp:v1 .
```

Database

```bash
docker build -t <dockerhub-username>/blood-bankdb:v1 ./database
```

---

# 📤 Push Images

```bash
docker login

docker push <dockerhub-username>/blood-bankapp:v1

docker push <dockerhub-username>/blood-bankdb:v1
```

---

# ☸️ Deploy Kubernetes Resources

Create Namespace

```bash
kubectl apply -f namespace.yaml
```

ConfigMap

```bash
kubectl apply -f configmap.yaml
```

Secret

```bash
kubectl apply -f secret.yaml
```

Persistent Volume

```bash
kubectl apply -f pvc.yaml
```

Database

```bash
kubectl apply -f db-statefulset.yaml
```

Database Service

```bash
kubectl apply -f db-service.yaml
```

Application

```bash
kubectl apply -f app-deployment.yaml
```

Application Service

```bash
kubectl apply -f app-service.yaml
```

Ingress (Optional)

```bash
kubectl apply -f ingress.yaml
```

---

# 📋 Verify Deployment

Pods

```bash
kubectl get pods -n bloodbank
```

Services

```bash
kubectl get svc -n bloodbank
```

StatefulSet

```bash
kubectl get statefulset -n bloodbank
```

Deployment

```bash
kubectl get deployment -n bloodbank
```

PVC

```bash
kubectl get pvc -n bloodbank
```

Ingress

```bash
kubectl get ingress -n bloodbank
```

---

# 🛢 Database Initialization

Login into MySQL

```bash
kubectl exec -it bloodbank-db-0 -n bloodbank -- mysql -uroot -p
```

Create Database

```sql
CREATE DATABASE bloodbank;
USE bloodbank;
```

Create Donors Table

```sql
CREATE TABLE donors(
id INT AUTO_INCREMENT PRIMARY KEY,
fname VARCHAR(255),
lname VARCHAR(255),
mobileno BIGINT UNIQUE,
city VARCHAR(255),
bfrom DATE,
bto DATE,
dob DATE,
bloodgroup VARCHAR(255)
);
```

Create Users Table

```sql
CREATE TABLE users(
username VARCHAR(80),
name VARCHAR(80),
password VARCHAR(80)
);
```

Insert Sample Users

```sql
INSERT INTO users VALUES
('admin','Administrator','admin123'),
('prashanth','Prashanth','12345'),
('vishal','Vishal','12345');
```

Grant Permission

```sql
CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY 'Admin@123';

GRANT ALL PRIVILEGES ON bloodbank.* TO 'root'@'%';

FLUSH PRIVILEGES;
```

---

# 🔐 ConfigMap Variables

```
MYSQL_HOST=bloodbank-db
MYSQL_DATABASE=bloodbank
```

---

# 🔒 Secret Variables

```
MYSQL_USER=root
MYSQL_PASSWORD=Admin@123
```

---

# 🔄 GitHub Actions CI/CD

Pipeline Flow

```
Developer

↓

Git Push

↓

GitHub Repository

↓

GitHub Actions

↓

Build Docker Images

↓

Push Images to Docker Hub

↓

SSH to Kubernetes Master

↓

kubectl set image

↓

Rolling Update

↓

Verify Pods

↓

Rollback (If Failed)
```

---

# 📈 Scaling Application

```bash
kubectl scale deployment bloodbank-app \
--replicas=5 \
-n bloodbank
```

---

# 🔄 Rolling Update

```bash
kubectl set image deployment/bloodbank-app \
bloodbank-app=<dockerhub-user>/blood-bankapp:v2 \
-n bloodbank
```

---

# ↩ Rollback

```bash
kubectl rollout undo deployment bloodbank-app \
-n bloodbank
```

---

# 🧪 Troubleshooting

## Check Pods

```bash
kubectl get pods -n bloodbank
```

## Describe Pod

```bash
kubectl describe pod <pod-name> -n bloodbank
```

## Application Logs

```bash
kubectl logs <app-pod> -n bloodbank
```

## Database Logs

```bash
kubectl logs bloodbank-db-0 -n bloodbank
```

## Exec into Pod

```bash
kubectl exec -it <app-pod> -n bloodbank -- bash
```

## Test Database Connection

```bash
php -r 'include "config.php"; var_dump($con);'
```

## Verify Database

```sql
SHOW DATABASES;

USE bloodbank;

SHOW TABLES;
```

---

# 🌐 Access Application

Using NodePort

```
http://<Node-IP>:<NodePort>
```

Example

```
http://192.168.1.218:30080
```

Using Ingress

```
https://bloodbank.local
```

(Add hosts file entry if using local Kubernetes.)

---

# 📌 Kubernetes Resources Used

- Namespace
- Deployment
- StatefulSet
- Service
- ConfigMap
- Secret
- PersistentVolumeClaim
- Ingress
- GitHub Actions
- Docker Hub

---

# 👨‍💻 Author

**Rohith Krish**

DevOps Engineer

**Tech Stack:** Docker • Kubernetes • GitHub Actions • Linux • MySQL • PHP • Apache