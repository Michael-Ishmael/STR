import os


def rename_files(dir, find, rep, target_dir):
	files = os.listdir(dir)
	for file in files:
		if file.endswith("jpg") and find in file:
			old_name = os.path.join(dir, file)
			new_name = os.path.join(target_dir, file.replace(find, rep))
			os.rename(old_name, new_name)


rename_files("..", "stripe-article", "stripe-article-8", "../../str_html/img")
