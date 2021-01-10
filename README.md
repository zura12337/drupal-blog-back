# Drupal Blog Back 
##### Drupal 9

### Installation 🚀

```
cd drupal-blog-back
composer install
```

#### Upload configuration
`drush cim -y`

If you get error like this: `Entities exist of type <em class="placeholder">Shortcut link</em>...`

Then go to `admin/config/user-interface/shortcut/` route and delete every shortcuts.

---
### Generate Content 🧬

```
drush en devel_generate -y
drush devel-generate:content 50
```

### API Endpoints 🔚

URL: http://localhost/project-folder/web

- `GET` All Blogs with image and topic: `/api/node/blog?include=field_image,field_topic`
- `GET` One Blog with image and topic: `/api/node/blog/:id?include=field_image,field_topic`
- `GET` All Topics: `/api/taxonomy_term/topic`
- `GET` One Topic: `/api/taxonomy_term/topic/:id`
- `POST` Get JWT: `/oauth/token`
###### Example Body
```json
{
	"grant_type": "password",
	"client_id": "xxxxe800-xxxx-42dd-xxxx-7d9d3f3exxxx",
	"client_secret": "root",
	"username": "root",
	"password": "root",
}
```
###### Example Headers
```json
{
	"Content-Type": "multipart/form-data"
}
```
- `POST` Upload Image: `/api/node/blog/field_image`
###### Example Headers
```json
{
	"Content-Type": "application/octet-stream",
	"Authorization": "--JWT Token--",
	"Content-Disposition": "file; filename=example_image.jpg"
}
```
- `POST` Upload Blog: `/api/node/blog/`
###### Example Body
```json
{
    "data": {
        "type": "node--blog",
        "attributes": {
            "title": "Blog Title",
            "body": {
                "value": "Some Dummy Body Text",
                "format": "plain_text"
            }
        },
        "relationships": {
            "field_image": {
                "data": {
                    "type": "file--file",
                    "id": "8dcfd0fd-baab-412f-9d8e-fee24b626bff"
                },
                "meta": {
                    "alt": "image",
                    "title": "Blog Title",
                    "width": null,
                    "height": null
                }
            },
            "field_topic": {
                "data": [
									{
                   	"type": "taxonomy_term--topic",
                    "id": "912e72cc-2c83-4d40-8a45-49dabe040380"
									},
								{
                    "type": "taxonomy_term--topic",
                    "id": "912e72cc-2c83-4d40-8a45-49dabe040380"
                }
								]
            }
        }
    }
}
```
