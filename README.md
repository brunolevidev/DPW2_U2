# DPW2_U2_BRVS BUILD COMMANDS

First install all Node dev dependencies

```bash
npm install
```

Then build webpack assets

```bash
npm run build
```

Install composer dependencies

```bash
composer install
```

Create dotenv file

```bash
mv .env.example .env
```

# TO RUN THIS APP

Execute in your terminal

```bash
docker build -t dpw2_u2_brvs .
```

Then 

```bash
docker run -dp 80:80 dpw2_u2_brvs
```