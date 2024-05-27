This project is a wordpress chatbot navigational plugin for a wordpress website. The website consisting of resources for people with aphasia. The chatbot assist users to navigate within the website. It takes text, audio and video as inputs and output text and audio. 

Following is the guide to setup the wordpress website and plugin locally. 

# WordPress site local setup guide

## **Setup local and wp_posts**

Install local ([https://localwp.com/](https://localwp.com/))

* Create a site in local as fusionflow2.
* Start the site and open the WP admin.
* In local go to the database tab and open the Adminer

![](https://lh7-us.googleusercontent.com/7flYVPlUYC9nAlBwWiHgaW-2YKGUYWiCdCvy06EbQXMpnQEKHi7xvzFnSj_3mQJCdrkieQA4LSuLwDtXAO5wBQ_RuliKqhwZR_7Ajzo_kagGEzE8m2Vx3Gq_edv_yl1tkz5W2-bCs3pBtgnFthintSc)

To get the WordPress website pages we have created, you have to set up the wp_posts from the database. You have to add the contents of the database to the wp_posts table.

![](https://lh7-us.googleusercontent.com/AAjbUR05jc6rpvcD4ahsFuO9LLCcdTUuYsiEQNGqSKhzlITCmAElL1m9oMa7DK05Dolr5FD-8HXeeLdAMxR3Z0a6pg8dFEUjelEaeaCWgG02rbWs2NAy2Myg49O50Q9pheYSecROwKs5THfC-PLk1eI)

First you have to delete the current data in the database and then to import the wp_posts.csv to the database.

![](https://lh7-us.googleusercontent.com/H3TOnTDJz1pmMLjQ5ES51s8hgXgwVI38dT5aO6S8MU8TGVV9YKZiblEBeLOwwq23k9Xnuoict5M6Zo3PATV0-quro4dsX0TPN25WNBV9BeSMLiH0isQNYi46NwIIHSaHteiONyqFqAWCbBeytN2tzo4)

You can download the database content as a CSV, from the following link.

[https://drive.google.com/file/d/1-uLRMzl9wDvH7kp8ZZXc6BwrcsKpIg6k/view?usp=sharing](https://drive.google.com/file/d/1-uLRMzl9wDvH7kp8ZZXc6BwrcsKpIg6k/view?usp=sharing)

Then add it to the empty wp_posts table by importing the CSV, file as follows.

![](https://lh7-us.googleusercontent.com/d_eYYMAUNf58VnBwz8f74Z7wngoklfU3q2FYNlUb4PwcSahRw5Hsfbdt7X4XvmEpKpeCEtAvxfcLkF1vJ1Ii4btNho8jF91kmT0tRQf8k3Ncvxq9i4ACTlcjzTQKrneY75_omy9pptrDiPWddJ96D-I)

## Sync codebase with github

We can access the codebase through the local application. `Go to site folder` takes you to the site folder.

You have to get a copy of the current folder before making any changes to the files in the folder.(Since some files would be cleared during the process of syncing with git, which needs to be replaced from that copied folder)

Follow the steps below.

* git init
* git remote add origin [https://github.com/fusion-flow/wordpress-site-plugin.git](https://github.com/fusion-flow/wordpress-site-plugin.git)
* git branch -M main (if the current branch is shown as master)
* Undo  and delete the commits that are shown (to avoid merge conflicts)
* git pull origin main
* Add the files/folders from the previously copied folder as mentioned in the gitignore file to the existing cloned project. (You have to replace even the existing folders mentioned in the gitignore.)

Now the wordpress website can be accessed through local. You can start the site and once it is started the Open site will open the website and the WP admin will open the admin page of the wordpress website.

![](https://lh7-us.googleusercontent.com/za-8LMVgH6iabuSMeiwm51xTA86oyUYEQh29pFpBkbPzqdko8nLjgLSnZWfCOVdraECitOmpkJLX6pXxbMRd1ZOPASgnH0Nh0WIgfEW37zTgV36NBCW_eW5WQGOyj7oxhyx1kGHiKkf_-f1qZUUb_XA)

From the WP admin you can enable the plugin fusionflow-chatbot-plugin-5 to enable the chatbot.

To get audio/video inputs we need to have a https website. Therefore to make this website considered as https do the following. Add the website link ([http://fusionflow2.local](http://fusionflow2.local)) to the chrome flags and enable it.

chrome://flags/#unsafely-treat-insecure-origin-as-secure
