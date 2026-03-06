RESOURCES=("node_modules/monaco-editor/min/vs")

for RESOURCE in "${RESOURCES[@]}"
do
	rm -rf src/public/$RESOURCE
    mkdir -p src/public/$RESOURCE
    cp -r $RESOURCE/* src/public/$RESOURCE
done
