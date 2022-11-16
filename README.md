# web-app-laravel
git clone https://github.com/donganhvuphp/web-app-laravel.git 

# khi lam 1 chuc nang moi
- git checkout develop
- git pull origin develop
- git checkout -b ten_nhanh develop
# vi du 
- git checkout -b donganh/APP-2 develop

# sau khi lam xong chưa commit 

- git stash
- git fetch origin develop
- git rebase origin/develop
- git stash pop

# fix conflict nếu có 
- git add ten_file
- git commit -m"noi dung commit"
- git push origin ten_nhanh

# sau khi push xong tạo merge request vào develop

#setup JWT
- php artisan jwt:secret



