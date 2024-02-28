import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:itr/core/models/document.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class UploadDocumentsScreen extends StatelessWidget {
  const UploadDocumentsScreen({
    Key? key,
    required this.category,
    required this.subCategory,
  }) : super(key: key);

  final String category;
  final String subCategory;

  static final List<Document> _documents = [
    Document(
      id: 'id',
      name: 'Document 1',
      category: 'category',
      subCategory: 'subCategory',
      createdAt: DateTime.now(),
    ),
    Document(
      id: 'id',
      name: 'Document 2',
      category: 'category',
      subCategory: 'subCategory',
      createdAt: DateTime.now(),
    ),
    Document(
      id: 'id',
      name: 'Document 3',
      category: 'category',
      subCategory: 'subCategory',
      createdAt: DateTime.now(),
    ),
  ];

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: TransparentAppBar(title: subCategory),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: GridView.builder(
          gridDelegate: const SliverGridDelegateWithMaxCrossAxisExtent(
            maxCrossAxisExtent: 175,
            mainAxisSpacing: 10,
            crossAxisSpacing: 10,
            childAspectRatio: 7 / 8,
          ),
          itemCount: _documents.length + 1,
          itemBuilder: (context, index) {
            if (index < _documents.length) {
              return GestureDetector(
                onTap: () {},
                child: Container(
                  padding: const EdgeInsets.all(4).copyWith(bottom: 8),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(
                      color: Theme.of(context)
                          .colorScheme
                          .primary
                          .withOpacity(0.25),
                      width: 0.7,
                    ),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Expanded(
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(18),
                          child: Image.network(
                            'https://content.altexsoft.com/media/2017/12/technical-documentation-example.png',
                            width: double.infinity,
                            fit: BoxFit.cover,
                          ),
                        ),
                      ),
                      const SizedBox(height: 8),
                      Text(
                        _documents[index].name,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                      Text(
                        DateFormat.yMMMd().format(_documents[index].createdAt),
                        style: Theme.of(context).textTheme.caption,
                      ),
                    ],
                  ),
                ),
              );
            }
            return GestureDetector(
              onTap: () {},
              child: Container(
                decoration: BoxDecoration(
                  color: Theme.of(context).colorScheme.secondary,
                  borderRadius: BorderRadius.circular(20),
                  border: Border.all(
                    color:
                        Theme.of(context).colorScheme.primary.withOpacity(0.25),
                    width: 0.7,
                  ),
                ),
                child: Center(
                  child: CircleAvatar(
                    maxRadius: 22,
                    backgroundColor: Theme.of(context).colorScheme.primary,
                    child: const Icon(
                      Icons.add,
                      color: Colors.white,
                      size: 40,
                    ),
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}
