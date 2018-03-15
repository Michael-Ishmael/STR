import os


def rename_files(dir, find, rep, target_dir):
	files = os.listdir(dir)
	for file in files:
		if file.endswith("png"):
			old_name = os.path.join(dir, file)
			new_name = os.path.join(target_dir, file.replace(file, "logo-" + file))
			os.rename(old_name, new_name)


rename_files("..", "stripe-article", "stripe-article-8", "../../str_html/img")
