// ext should include the dot, for example '.html'
function changeExtension(file, ext) {
  return path.join(path.dirname(file), path.basename(file, path.extname(file)) + ext)
}