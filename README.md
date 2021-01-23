# pHtml
thanks to this library, which is currently in development, you can only do backend and frontend functions with PHP without using HTML, with simple and changeable functions.

## Simple Functions

### Tag

#### tag.create
```php
/*  tag.create(tagName, name, customableStyle, content);*/
tag.create(h2, testTag, color:"red" font-size:"28px", "Hello World");
```
* When we use this function, it will generate an h2 tag in "Red" color, "24px" and that says "Hello World". 
* State of development : %80(Development Complated, Bug Fix Phase)
#### tag.delete
```php
/* tag.delete(name) */
tag.delete("testTag");
```
* When this function is entered, all tags named "testTag" in the file will be deleted. Please give a separate name for each tag so that they are not deleted to all.
* State of development : %0(Not started to Development)

#### tag.edit
```
/* tag.edit(name, element.create function) */
tag.edit("testTag", tag.create(h2, testTag, color:"red" font-size:"28px", "Hi"));
```
* When this function is entered, the texts in all tags named "testTag" in the file will be changed to "Hi". Please name each one separately so that they do not change.
* State of development : %0(Not started to Development)
