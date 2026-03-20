1) Go to the research clone folder (important)
cd ~/work/Projects/research/nka-hub

2) Bring it down and delete ONLY its volumes

This removes:

containers created by this compose file

the network created by this compose file

volumes created for this compose project (nka-hub_*)

docker compose down --volumes --remove-orphans


✅ This will not remove volumes from your original project as long as you run it from the research folder.

3) (Optional but clean) Remove only its built image

If you want to rebuild cleanly next time:

docker compose down --rmi local --volumes --remove-orphans


Or if you already did step 2, just:

docker image rm nka-hub-laravel 2>/dev/null || true


(No harm if it says “No such image”.)

4) Confirm the research volumes are gone (sanity check)

List volumes that belong to the research project:

docker volume ls | grep -E '^local\s+nka-hub_'


If nothing prints, you’re clean.

Also check the original project volumes still exist:

docker volume ls | grep -E '^local\s+nka-academic-management-system_'


Those should still be there.

5) Recreate the research clone cleanly (recommended workflow)
A) Delete the folder (only the clone folder)
cd ~/work/Projects/research
rm -rf nka-hub

B) Clone again
git clone git@github.com:rukman28/nka-hub.git
cd nka-hub

C) Create .env from .env.example
cp .env.example .env

D) Boot containers
docker compose up -d --build

E) Install dependencies (inside container)
docker compose run --rm --entrypoint composer laravel install

F) Generate APP_KEY (now that vendor exists)
docker exec -it nka-hub-laravel-1 php artisan key:generate

G) Migrate + seed (interactive)
docker exec -it nka-hub-laravel-1 php artisan migrate:fresh
docker exec -it nka-hub-laravel-1 php artisan db:seed

Extra safety tip (optional but strong)

If you ever worry about name collisions, you can force a unique Compose project name for the research clone:

COMPOSE_PROJECT_NAME=nka_hub_research docker compose up -d


Then everything will be clearly prefixed with nka_hub_research_....

If you paste the output of:

docker volume ls | grep -E 'nka-hub|nka-academic-management-system'
